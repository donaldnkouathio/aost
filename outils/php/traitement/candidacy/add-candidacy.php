<?php

/* INCOMPLET (Manque pour partie creer mon CV)*/

session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';



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
		'domains'=>$_POST['domains'],
		'about'=>$_POST['about'],
		'cv_file'=>$_POST['name'],
		'motivation_file'=>$_POST['name'],
		'deleted'=>0,
		'added_at'=>date("Y-m-d H:i:s")
	];


	$candidacy=new Candidacy($current_candidacy);


	if(!empty($_FILES)){
		$data=0;
		$filename=basename($_FILES['cv_file']['name']);
		$ext=pathinfo($filename, PATHINFO_EXTENSION);
		$tmp=$_FILES['cv_file']['tmp_name'];
		$type=$_FILES['cv_file']['type'];
		$size=$_FILES['cv_file']['size'];
		$error=$_FILES['cv_file']['error'];
		$tab_ext=array('PDF','pdf');


		if(in_array($ext, $tab_ext)){
			if($size<10*1024*1024){

				if($candidacy->addCandidacy($candidacy)){
					$last_candidacy=$candidacy->getLastCandidacy();

					$candidacy_folder=_APP_PATH."files/candidacys/".$last_candidacy->getId();

					$file_renamed=$last_candidacy->getId().".".$ext;

					mkdir($candidacy_folder);

					if(move_uploaded_file($tmp, $candidacy_folder."/".$file_renamed)){

						$data=true;

					}else{
						$data="Erreur lors de l'upload du fichier... Veuillez réessayer !";
					}
				}else{
					$data="Erreur lors d'execution, Veuillez réessayer !";
				}

			}else{
				$data="fichier trop lourd ! Veuillez choisir un fichier de moins de 10 Mo";

			}
		}else{
			$data="Extension du fichier non prise en charge ! Choisissez un fichier au format PDF...";
		}
	}else{
		$data=true;
		$candidacy->addCandidacy($candidacy);
	}
}






?>