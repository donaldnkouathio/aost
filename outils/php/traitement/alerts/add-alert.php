<?php


session_start();
require_once 'init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$current_alert=[
	'id'=>0,
	'id_domain'=>$_POST['id_domain'],
	'id_subdomain'=>$_POST['id_subdomain'],
	'email'=>$_POST['email'],
	'cv_file'=>$_POST['cv_file'],
	'added_at'=>""
];

$alert=new Alert($current_alert);


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

			if($alert->addAlert($alert)){
				$last_alert=$alert->getLastAlert();
				
				$alert_folder=_APP_PATH."files/alerts/".$last_alert->getId();

				$file_renamed=$last_alert->getId().".".$ext;

				mkdir($alert_folder);

				if(move_uploaded_file($tmp, $alert_folder."/".$file_renamed)){

					$data=true;

				}else{
					$data="Erreur lors de l'upload de l'image... Veuillez réessayer !";
				}
			}else{
				$data="Erreur lors d'execution, Veuillez réessayer !";
			}

		}else{
			$data="fichier trop lourd ! Veuillez choisir un fichier de moins de 10 Mo";
			
		}
	}else{
		$data="Extension de fichier non pris en charge ! Choisissez un autre fichier...";
	}
}else{
	$data=true;
	$alert->addAlert($alert);
}

header("Location:../../../../job/prompt-application/index.php?data=".$data);






?>