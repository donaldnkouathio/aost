<?php

/*INCOMPLET */


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$current_alert=[
	'id'=>0,
	'id_city'=>$_POST['city'],
	'email'=>$_POST['email'],
	'domain'=>substr($_POST['domain'], 0,strlen($_POST['domain'])-1),
	'name'=>$_POST['name'],
	'first_name'=>$_POST['first_name'],
	'phone'=>$_POST['phone'],
	'about'=>$_POST['about'],
	'cv_file'=>"",
	'added_at'=>date("Y-m-d H:i:s")
];

$alert=new Alert($current_alert);


if($_POST['request_type']=="have_cv"){
	$data=0;
	$filename=basename($_FILES['cv_file']['name']);
	$ext=pathinfo($filename, PATHINFO_EXTENSION);
	$tmp=$_FILES['cv_file']['tmp_name'];
	$type=$_FILES['cv_file']['type'];
	$size=$_FILES['cv_file']['size'];
	$error=$_FILES['cv_file']['error'];
	$tab_ext=array('PDF','pdf','docx','DOCX');

	/* TO DELETE WHEN SELECT CITY FORM WILL BE OK */
	$alert->setCv_file("Cv_".$alert->getName()."_".$alert->getId_city().".".$ext);

	/*
	TO SET ON WHEN SELECT CITY FORM WILL BE OK 
	
	$city=new City($current_city);
	$city=$city->getCity($alert->getId_city());
	$alert->setCv_file("Cv_".$alert->getName()."_".$city->getName().".".$ext);
	
	*/

	if(in_array($ext, $tab_ext)){
		if($size<10*1024*1024){

			if($alert->addAlert($alert)){
				$last_alert=$alert->getLastAlert();
				
				$alert_folder=_APP_PATH."files/alerts/".$last_alert->getId();

				$file_renamed="Alert_Cv_".$alert->getName()."_".$alert->getId_city().".".$ext;

				mkdir($alert_folder);

				if(move_uploaded_file($tmp, $alert_folder."/".$file_renamed)){

					$data=true;

				}else{
					$data="Erreur lors de l'upload du cv_file... Veuillez réessayer !";
				}
			}else{
				$data="Erreur d'execution, Veuillez réessayer !";
			}

		}else{
			$data="fichier trop lourd ! Veuillez choisir un fichier de moins de 10 Mo";
			
		}
	}else{
		$data="Extension de fichier non pris en charge ! Choisissez un autre fichier...";
	}

}else if($_POST['request_type']=="make_cv"){
	require('../../fpdf/fpdf.php');

	/* CREATION/GENERATION DU CV */

	$alert->setCv_file("Alert_Cv_".$alert->getName()."_".$alert->getId_city().".pdf");
	$cv_renamed="Alert_Cv_".$alert->getName()."_".$alert->getId_city().".pdf";

	$pdf = new FPDF();

	$pdf->AddPage();

	//set font to arial, bold, 14pt
	$pdf->SetFont('Arial',false,14);

	//Cell(width , height , text , border , end line , [align] )

	$pdf->Cell(190,10,'CURRICULUM VITAE',0,1,'C');
	$pdf->Cell(190,20,'PRESENTATION',0,1,'C');
	$pdf->Cell(190,10,'Nom: '.$alert->getName(),0,1,'L');
	$pdf->Cell(190,10,utf8_decode('Prénom: ').utf8_decode($alert->getFirst_name()),0,1,'L');
	$pdf->Cell(190,10,utf8_decode('Téléphone: ').$alert->getPhone(),0,1,'L');
	$pdf->Cell(190,10,'Ville: '.utf8_decode($alert->getId_city()),0,1,'L');
	$pdf->Cell(190,10,'Email: '.$alert->getEmail(),0,1,'L');
	$pdf->Cell(190,10,'Domaine: '.utf8_decode($alert->getDomain()),0,1,'L');
	$pdf->Cell(190,20,'',0,1,'L');
	$pdf->Write(5,utf8_decode($alert->getAbout()));

	if($alert->addalert($alert)){

		$last_alert=$alert->getLastAlert();

		$alert_folder=_APP_PATH."files/alerts/".$last_alert->getId();

		mkdir($alert_folder);

		if($pdf->Output($alert_folder."/".$cv_renamed,'F')){
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