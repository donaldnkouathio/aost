<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';

header("Content-Type: text/html;charset=utf-8");

$data=0;


$id_offer=NULL;
$id_subdomain=NULL;

if(isset($_POST['id_offer'])){
	if($_POST['id_offer']!=""){
		$id_offer=$_POST['id_offer'];

		$offer=new Offer($current_offer);
		$offer=$offer->getOffer($_POST['id_offer']);

		$id_subdomain=$offer->getId_subdomain();
	}
}



$current_candidacy=[
	'id'=>0,
	'id_offer'=>$id_offer,
	'id_subdomain'=>$id_subdomain,
	'city'=>$_POST['city'],
	'name'=>$_POST['name'],
	'first_name'=>$_POST['first_name'],
	'phone'=>$_POST['phone'],
	'email'=>$_POST['email'],
	'domains'=>substr($_POST['domain'], 0,strlen($_POST['domain'])-1),
	'about'=>$_POST['about'],
	'cv_file'=>"",
	'motivation_file'=>"",
	'alert'=>$_POST['alert'],
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

	/* MOTIVATION FILE PART */
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

					/*MOTIVATION UPLOAD PART*/
					$tmp_motivation=$_FILES['motivation_file']['tmp_name'];

					if(move_uploaded_file($tmp_motivation, $candidacy_folder."/".$motivation_renamed)){
						$data=true;
					}else{
						$data="Erreur lors de l'upload de la lettre de motivation... Veuillez réessayer !";
					}
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

	require('../../mpdf/vendor/autoload.php');
	$mpdf= new \Mpdf\Mpdf();




	$candidacy->setCv_file("Candidature_Cv_".$candidacy->getName().".pdf");
	$cv_renamed="Candidature_Cv_".$candidacy->getName().".pdf";

	$mpdf->SetTitle("Candidature_Cv_".$candidacy->getName());
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
	<td>'.$candidacy->getName().'</td>
	</tr>
	<tr>
	<td>Prénom</td>
	<td>'.$candidacy->getFirst_name().'</td>
	</tr>
	<tr>
	<td>Téléphone</td>
	<td>'.$candidacy->getPhone().'</td>
	</tr>
	<tr>
	<td>Email</td>
	<td>'.$candidacy->getEmail().'</td>
	</tr>
	<tr>
	<td>Ville</td>
	<td>'.$candidacy->getCity().'</td>
	</tr>
	<tr>
	<td>Catégorie d\'emploi</td>
	<td>'.$candidacy->getDomains().'</td>
	</tr>
	</table>
	</div>
	<div class="ttl-line">Description du profil</div>
	<div class="line-content profile">
	'.$candidacy->getAbout().'
	</div>
	</div>
	</div>

	<div class="footer-cv"><i>Made by AOST</i></div>
	</body>
	</html>
	';

	$mpdf->WriteHTML($html);

	if($candidacy->addCandidacy($candidacy)){

		$last_candidacy=$candidacy->getLastCandidacy();

		if(!file_exists(_APP_PATH."files/candidacy")){
			mkdir(_APP_PATH."files/candidacy");
		}

		$candidacy_folder=_APP_PATH."files/candidacy/".$last_candidacy->getId();

		mkdir($candidacy_folder);

		$mpdf->Output($candidacy_folder."/".$cv_renamed);
		$data=true;

	}else{
		$data="Erreur lors d'execution, Veuillez réessayer !";
	}

}else{
	echo "Valeur de retour inconnue !";
}


echo $data;





?>
