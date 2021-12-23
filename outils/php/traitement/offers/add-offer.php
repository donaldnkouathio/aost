<?php


session_start();
require_once 'init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';

$deadline=date('Y-m-d H:i:s', strtotime('+ 2 MONTH'))

if(isset($_POST['deadline']) && !empty($_POST['deadline'])){
	$deadline=$_POST['deadline']." ".date('H:i:s');
}


$current_offer=[
	'id'=>0,
	'id_admin'=>$_SESSION['id'],
	'id_domain'=>$_POST['id_domain'],
	'id_subdomain'=>$_POST['id_subdomain'],
	'compagny'=>$_POST['compagny'],
	'profession'=>$_POST['profession'],
	'city'=>$_POST['city'],
	'image'=>$_POST['image'],
	'description'=>$_POST['description'],
	'missions'=>$_POST['missions'],
	'skill'=>$_POST['skill'],
	'candidate_profile'=>$_POST['candidate_profile'],
	'cv'=>$_POST['cv'],
	'motivation'=>$_POST['motivation'],
	'deleted'=>0,
	'expired'=>0,
	'deadline'=>$deadline,
	'added_at'=>date("Y-m-d H:i:s");
];

$offer=new Offer($current_offer);


if(!empty($_FILES)){
	$data=0;
	$filename=basename($_FILES['image']['name']);
	$ext=pathinfo($filename, PATHINFO_EXTENSION);
	$tmp=$_FILES['image']['tmp_name'];
	$type=$_FILES['image']['type'];
	$size=$_FILES['image']['size'];
	$error=$_FILES['image']['error'];
	$tab_ext=array('png','jpg','webp','PNG','JPG','jpeg','JPEG');


	if(in_array($ext, $tab_ext)){
		if($size<10*1024*1024){

			if($offer->addOffer($offer)){
				$last_offer=$offer->getLastOffer();
				
				$offer_folder=_APP_PATH."files/offers/".$last_offer->getId();

				$file_renamed=$last_offer->getId().".".$ext;

				mkdir($offer_folder);

				if(compressImage($tmp, $offer_folder."/".$file_renamed, 25)){

					$data=true;

				}else{
					$data="Erreur lors de l'upload de l'image... Veuillez réessayer !";
				}
			}else{
				$data="Erreur lors de l'ajout de l'offre, Veuillez réessayer !";
			}

		}else{
			$data="Image trop lourde ! Veuillez choisir une image de moins de 10 Mo";
			
		}
	}else{
		$data="Extension de fichier d'image non pris en charge ! Choisissez une autre image...";
	}
}else{
	$data=true;
	$offer->addOffer($offer);
}


header("Location:../../../../dashboard/index.php?data=".$data);






?>