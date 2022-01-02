<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';

header("Content-Type: text/html;charset=utf-8");

$data=0;

$offer=new Offer($current_offer);
$offer=$offer->getOffer($_POST['id_offer']);

$current_candidacy=[
	'id'=>0,
	'id_offer'=>$offer->getId(),
	'id_subdomain'=>$offer->getId_subdomain(),
	'city'=>$_POST['city'],
	'name'=>$_POST['name'],
	'first_name'=>$_POST['first_name'],
	'phone'=>$_POST['phone'],
	'email'=>$_POST['email'],
	'domains'=>substr($_POST['domain'], 0,strlen($_POST['domain'])-1),
	'about'=>$_POST['about'],
	'cv_file'=>"",
	'motivation_file'=>"",
	'deleted'=>0,
	'added_at'=>date("Y-m-d H:i:s")
];


$candidacy=new Candidacy($current_candidacy);

if($_POST['request_type']=="have_cv"){

	if(isset($_FILES['cv_file'])){
		$filename=basename($_FILES['cv_file']['name']);
		$ext=pathinfo($filename, PATHINFO_EXTENSION);
		$tmp=$_FILES['cv_file']['tmp_name'];
		$type=$_FILES['cv_file']['type'];
		$size=$_FILES['cv_file']['size'];
		$error=$_FILES['cv_file']['error'];
		$tab_ext=array('PDF','pdf');

		if(in_array($ext, $tab_ext)){
			if($size<10*1024*1024){
				$data=1;
				$candidacy->setCv_file("Candidature_Cv_".$candidacy->getName().".".$ext);
			}else{
				$data="Fichier du CV trop lourd ! Veuillez choisir un fichier de moins de 10 Mo";
			}
		}else{
			$data="Extension du fichier non prise en charge ! Choisissez un fichier au format PDF...";
		}
	}else{
		$data="CV manquant... Veuillez insérer votre CV (au format PDF)";
	}

	/* MOTIVATION FILE PART
	if($data==1){
		if(isset($_FILES['motivation_file'])){
			$filename=basename($_FILES['motivation_file']['name']);
			$ext=pathinfo($filename, PATHINFO_EXTENSION);
			$tmp=$_FILES['motivation_file']['tmp_name'];
			$type=$_FILES['motivation_file']['type'];
			$size=$_FILES['motivation_file']['size'];
			$error=$_FILES['motivation_file']['error'];
			$tab_ext=array('PDF','pdf');

			if(in_array($ext, $tab_ext)){
				if($size<10*1024*1024){
					$data=1;
					$candidacy->setMotivation_file("Candidature_Motivation_".$candidacy->getName().".".$ext);
				}else{
					$data="Fichier de motivation trop lourd ! Veuillez choisir un fichier de moins de 10 Mo";
				}
			}else{
				$data="Extension du fichier non prise en charge ! Choisissez un fichier au format PDF...";
			}
		}
	}
	*/

	if($data==1){
		if($candidacy->addCandidacy($candidacy)){

			$tmp_cv=$_FILES['cv_file']['tmp_name'];

			$last_candidacy=$candidacy->getLastCandidacy();

			$candidacy_folder=_APP_PATH."files/candidacy/".$last_candidacy->getId();

			$cv_renamed="Candidature_Cv_".$candidacy->getName().".".$ext;
			$motivation_renamed="Candidature_Motivation_".$candidacy->getName().".".$ext;

			mkdir($candidacy_folder);

			if(move_uploaded_file($tmp_cv, $candidacy_folder."/".$cv_renamed)){

				if(isset($_FILES['motivation_file'])){

					/*MOTIVATION UPLOAD PART
					$tmp_motivation=$_FILES['motivation_file']['tmp_name'];
					
					if(move_uploaded_file($tmp_motivation, $candidacy_folder."/".$motivation_renamed)){
						$data=true;
					}else{
						$data="Erreur lors de l'upload de la lettre de motivation... Veuillez réessayer !";		
					}
					*/
				}else{
					$data=true;
				}

			}else{
				$data="Erreur lors de l'upload du CV... Veuillez réessayer !";
			}
		}else{
			$data="Erreur lors d'execution, Veuillez réessayer !";
		}
	}




}else if($_POST['request_type']=="make_cv"){
	
	require('../../fpdf/fpdf.php');

	/* CREATION/GENERATION DU CV */

	$candidacy->setCv_file("Candidature_Cv_".$candidacy->getName().".pdf");
	$cv_renamed="Candidature_Cv_".$candidacy->getName().".pdf";

	$pdf = new FPDF();

	$pdf->AddPage();

	//set font to arial, bold, 14pt
	$pdf->SetFont('Arial',false,14);

	//Cell(width , height , text , border , end line , [align] )

	$pdf->Cell(190,10,'CURRICULUM VITAE',0,1,'C');
	$pdf->Cell(190,20,'PRESENTATION',0,1,'C');
	$pdf->Cell(190,10,'Nom: '.$candidacy->getName(),0,1,'L');
	$pdf->Cell(190,10,utf8_decode('Prénom: ').utf8_decode($candidacy->getFirst_name()),0,1,'L');
	$pdf->Cell(190,10,utf8_decode('Téléphone: ').$candidacy->getPhone(),0,1,'L');
	$pdf->Cell(190,10,'Ville: '.utf8_decode($candidacy->getCity()),0,1,'L');
	$pdf->Cell(190,10,'Email: '.$candidacy->getEmail(),0,1,'L');
	$pdf->Cell(190,10,'Domaine: '.utf8_decode($candidacy->getDomains()),0,1,'L');
	$pdf->Cell(190,20,'',0,1,'L');
	$pdf->Write(5,utf8_decode($candidacy->getAbout()));

	if($candidacy->addCandidacy($candidacy)){

		$last_candidacy=$candidacy->getLastCandidacy();

		$candidacy_folder=_APP_PATH."files/candidacy/".$last_candidacy->getId();

		mkdir($candidacy_folder);

		if($pdf->Output($candidacy_folder."/".$cv_renamed,'F')){
			$data=true;
		}else{
			$data="Erreur lors de la création de votre CV... Veuillez réessayer !";
		}	
	}else{
		$data="Erreur lors d'execution, Veuillez réessayer !";
	}


}else{
	echo "Valeur de retour inconnue !";
}


echo $data;





?>