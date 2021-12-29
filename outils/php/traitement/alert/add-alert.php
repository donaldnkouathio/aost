<?php

/*INCOMPLET */


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$current_alert=[
	'id'=>0,
	'email'=>$_POST['email'],
	'domain'=>$_POST['domain'],
	'name'=>$_POST['name'],
	'first_name'=>$_POST['first_name'],
	'phone'=>$_POST['phone'],
	'city'=>$_POST['city'],
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

	$alert->setCv_file("Cv_".$_POST['name']."_".$_POST['city'].".".$ext);


	if(in_array($ext, $tab_ext)){
		if($size<10*1024*1024){

			if($alert->addAlert($alert)){
				$last_alert=$alert->getLastAlert();
				
				$alert_folder=_APP_PATH."files/alerts/".$last_alert->getId();

				$file_renamed="Cv_".$_POST['name']."_".$_POST['city'].".".$ext;

				mkdir($alert_folder);

				if(move_uploaded_file($tmp, $alert_folder."/".$file_renamed)){

					$data=true;

					echo "saved";

				}else{
					$data="Erreur lors de l'upload de l'cv_file... Veuillez réessayer !";
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
	

}

header("Location:../../../../job/prompt-application/index.php?data=".$data);







?>