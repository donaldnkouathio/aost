<?php

/*INCOMPLET */


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$current_alert=[
	'id'=>0,
	'city'=>$_POST['city'],
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

	$alert->setCv_file("Cv_".$alert->getName()."_".$alert->getCity().".".$ext);

	if(in_array($ext, $tab_ext)){
		if($size<10*1024*1024){

			if($alert->addAlert($alert)){
				$last_alert=$alert->getLastAlert();
				
				$alert_folder=_APP_PATH."files/alerts/".$last_alert->getId();

				$file_renamed="Alert_Cv_".$alert->getName()."_".$alert->getId_city().".".$ext;

				if(!file_exists($alert_folder)){
					mkdir($alert_folder);
				}

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
	require('../../mpdf/vendor/autoload.php');
	$mpdf= new \Mpdf\Mpdf();

	

	
	$alert->setCv_file("Candidature_Cv_".$alert->getName().".pdf");
	$cv_renamed="Candidature_Cv_".$alert->getName().".pdf";

	$mpdf->SetTitle("Candidature_Cv_".$alert->getName());
	$mpdf->SetAuthor("AOST");
	$mpdf->SetCreator("AOST");
	$mpdf->showImageErrors = true;
	$mpdf->SetSubject("CV made by AOST");


	$html='
	<!DOCTYPE html>
	<html lang="en">
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
	.content-cv{
		width: 95%;
		height: auto;
		margin: auto;
		padding-bottom: 50px;
	}

	.head-cv{
		width: 100%;
		height: auto;
		display: flex;
	}

	.image-cv{
		width: 20%;
		height: 200px;
		text-align: center;
	}

	.image-cv img{
		max-height: 100%;
		max-width: 100%;
	}

	.title-cv{
		width: 100%;
		padding-top: -60px;
		text-align: center;
		font-size: 26px;
		font-weight: bolder;
		color: #003068;
	}


	.body-cv{
		width: 100%;
		height: auto;
	}

	.ttl-line{
		width: 100%;
		height: 30px;
		font-size: 20px;
		border-bottom: solid 2px #003068;
		color: #003068;
		margin-top: 30px;
	}

	.line-content{
		width: 96%;
		padding-left: 4%;
		height: auto;
		margin-top: 10px;
	}

	.table-cv td{
		width: 60%;
		height: 35px;
	}
	.profile{
		padding-top: 15px;
	}

	.footer-cv{
		width:80%;
		height:auto;
		position:absolute;
		bottom:50px;
		text-align: right;
		border-bottom: solid 1px #003068;
	}


	</style>
	<title>Document</title>
	</head>
	<body>
	<div class="content-cv">
	<div class="head-cv">
	<div class="image-cv">
	<img src="'._APP_PATH.'img/logo.png" alt="">
	</div>
	<div class="title-cv">CURRICULUM VITAE</div>
	</div>
	<div class="body-cv">
	<div class="ttl-line">Détails personnels</div>
	<div class="line-content">
	<table border="0" class="table-cv">
	<tr>
	<td>Nom</td>
	<td>'.$alert->getName().'</td>
	</tr>
	<tr>
	<td>Prénom</td>
	<td>'.$alert->getFirst_name().'</td>
	</tr>
	<tr>
	<td>Téléphone</td>
	<td>'.$alert->getPhone().'</td>
	</tr>
	<tr>
	<td>Email</td>
	<td>'.$alert->getEmail().'</td>
	</tr>
	<tr>
	<td>Ville</td>
	<td>'.$alert->getCity().'</td>
	</tr>
	<tr>
	<td>Catégorie d\'emploi</td>
	<td>'.$alert->getDomain().'</td>
	</tr>
	</table>
	</div>
	<div class="ttl-line">Description du profil</div>
	<div class="line-content profile">
	'.$alert->getAbout().'
	</div>
	</div>
	</div>

	<div class="footer-cv"><i>Made by AOST</i></div>
	</body>
	</html>
	';

	$mpdf->WriteHTML($html);

	if($alert->addAlert($alert)){

		$last_alert=$alert->getLastalert();

		if(!file_exists(_APP_PATH."files/alerts")){
			mkdir(_APP_PATH."files/alerts");
		}

		$alert_folder=_APP_PATH."files/alerts/".$last_alert->getId();

		mkdir($alert_folder);

		$mpdf->Output($alert_folder."/".$cv_renamed);
		$data=true;
		
	}else{
		$data="Erreur lors d'execution, Veuillez réessayer !";
	}


}else{
	echo "Valeur de retour inconnue !";
}


echo $data;







?>