<?php

/* INCOMPLET (Manque pour partie creer mon CV)*/

session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$data=0;

if($_POST['request_type']=="have_cv"){
	$offer=new Offer($current_offer);
	$offer=$offer->getOffer($_POST['id_offer']);

	$current_candidacy=[
		'id'=>0,
		'id_offer'=>$offer->getId(),
		'id_subdomain'=>$offer->getId_subdomain(),
		'id_city'=>$_POST['city'],
		'name'=>$_POST['name'],
		'first_name'=>$_POST['first_name'],
		'phone'=>$_POST['phone'],
		'email'=>$_POST['email'],
		'domains'=>$_POST['domain'],
		'about'=>$_POST['about'],
		'cv_file'=>"",
		'motivation_file'=>"",
		'deleted'=>0,
		'added_at'=>date("Y-m-d H:i:s")
	];


	$candidacy=new Candidacy($current_candidacy);

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
				$candidacy->setCv_file("Candidature_Cv_".$_POST['name'].".".$ext);
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
					$candidacy->setMotivation_file("Candidature_Motivation_".$_POST['name'].".".$ext);
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

			$cv_renamed="Candidature_Cv_".$_POST['name'].".".$ext;
			$motivation_renamed="Candidature_Motivation_".$_POST['name'].".".$ext;

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
}


echo $data;





?>