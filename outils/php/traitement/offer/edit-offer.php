<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$offer=new Offer($current_offer);

$offer=$offer->getOffer($_POST['id']);

$offer->setId_domain($_POST['id_domain']);
$offer->setId_subdomain($_POST['id_subdomain']);
$offer->setProfession($_POST['profession']);
$offer->setCompagny($_POST['compagny']);
$offer->setCity($_POST['city']);
$offer->setImage($_POST['image']);
$offer->setDescription($_POST['description']);
$offer->setMissions($_POST['missions']);
$offer->setSkill($_POST['skill']);
$offer->setCandidate_profile($_POST['candidate_profile']);
$offer->setCv($_POST['cv']);
$offer->setMotivation($_POST['motivation']);
$offer->setDeleted($_POST['deleted']);
$offer->setExpired($_POST['expired']);
$offer->setDeadline($_POST['deadline']);



if(!empty($_FILES)){
	$data=0;
	$filename=basename($_FILES['image']['name']);
	$ext=pathinfo($filename, PATHINFO_EXTENSION);
	$file_renamed=$offer->getId().".".$ext;
	$tmp=$_FILES['image']['tmp_name'];
	$type=$_FILES['image']['type'];
	$size=$_FILES['image']['size'];
	$error=$_FILES['image']['error'];
	$tab_ext=array('png','jpg','webp','PNG','JPG','jpeg','JPEG');


	if(in_array($ext, $tab_ext)){
		if($size<10*1024*1024){
			foreach ($tab_ext as $ext) {
				if(file_exists(_APP_PATH."files/offers/".$offer->getId()."/".$offer->getId().".".$ext)){
					unlink(_APP_PATH."files/offers/".$offer->getId()."/".$offer->getId().".".$ext);	
				}	
			}

			if(compressImage($tmp, _APP_PATH."files/offers/".$offer->getId()."/".$file_renamed, 25)){
				$offer->editOffer($offer);

				$data=true;

			}else{
				$data="Erreur lors de l'upload de l'image... Veuillez réessayer !";
			}

		}else{
			$data="Image trop lourde ! Veuillez choisir une image de moins de 10 Mo";
			
		}
	}else{
		$data="Extension de fichier d'image non pris en charge ! Choisissez une autre image...";
	}
}else{
	$data=true;
	$offer->editOffer($offer);
}


echo $data;







?>