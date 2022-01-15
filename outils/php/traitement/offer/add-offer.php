<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';

//Include required PHPMailer files
require_once _APP_PATH.'outils/php/phpmailer/PHPMailer.php';
require_once _APP_PATH.'outils/php/phpmailer/SMTP.php';
require_once _APP_PATH.'outils/php/phpmailer/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$deadline=date('Y-m-d H:i:s', strtotime('+ 2 MONTH'));

if(isset($_POST['deadline']) && !empty($_POST['deadline'])){
	$deadline=$_POST['deadline']." ".date('H:i:s');
}


$current_offer=[
	'id'=>0,
	'id_admin'=>1,
	'id_subdomain'=>$_POST['id_subdomain'],
	'id_city'=>$_POST['city'],
	'compagny'=>$_POST['compagny'],
	'description'=>$_POST['description'],
	'missions'=>$_POST['missions'],
	'skill'=>$_POST['skill'],
	'candidate_profile'=>$_POST['candidate_profile'],
	'cv'=>$_POST['cv'],
	'motivation'=>$_POST['motivation'],
	'deleted'=>0,
	'expired'=>0,
	'deadline'=>$deadline,
	'added_at'=>date("Y-m-d H:i:s")
];

$offer=new Offer($current_offer);
// AJOUT DE L'OFFRE
if($offer->addOffer($offer)){

	$last_offer=$offer->getLastOffer();

	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin($_SESSION['id']);

	$admin->updateLastSeen($_SESSION['id']);

	$subdomain=new Subdomain($current_subdomain);
	$subdomain=$subdomain->getSubdomain($offer->getId_subdomain());

	// AJOUT DANS L'HISTORIQUE
	$current_history=[
		'id'=>0,
		'id_admin'=>$_SESSION['id'],
		'id_target'=>$last_offer->getId(),
		'action'=>"add offer",
		'description'=>$admin->getName()." a ajouté une offre dans la catégorie ".$subdomain->getName(),
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	$history->addHistory($history);

	// ALERTE DES EMPLOIS DE LA CATEGORIE DE L'OFFRE
	$domain= new Domain($current_domain);
	$domain=$domain->getDomain($subdomain->getId_domain());

	$candidacy=new Candidacy($current_candidacy);



	$candidacy_alerts=$candidacy->getAlertsCandidacy($subdomain->getName());

	$link=_ROOT_PATH.'job/offers/a/'.str_replace(" ", "-",$subdomain->getName()).'/'.$last_offer->getId().'/';
	$description='<a href="'.$link.'">'.$domain->getName().' – '.$subdomain->getName().' – Canada</a><br>'.$offer->getDescription();

	$competences=$offer->getSkill().'<br>
	<i style="color:red;">Expiration: '.get_expired_time($deadline).'</i>';

	foreach ($candidacy_alerts as $candidacy_alert) {

		//$link_off_alert='www.aost.ca/outils/php/traitement/candidacy/delete-alert-candidacy.php?email='.$candidacy_alert->getEmail().'&id_subdomain='.$offer->getId_subdomain();


		//$link_off_alerts='www.aost.ca/outils/php/traitement/candidacy/delete-alerts-candidacy.php?email='.$candidacy_alert->getEmail();


		$titre='Salut '.$candidacy_alert->getName().',<br>
		Ceci est un emplois correspondant à vos paramètres d\'alerte d\'emploi. <br><u>NB</u>: <i>Cliquez sur le bouton "Postuler Maintenant", lisez l\'offre et envoyez votre candidature uniquement si vous avez le profil demandé</i>';

		$message='
		<html>
		<head>
		<style>
		.auto-div-email{
			width: 100%;
			height: auto;
			padding-top: 10px;
			padding-bottom: 10px;
		}

		.content-email{
			width: 100%;
			height: auto;
			padding-bottom: 25px;
			border-radius: 15px;
			box-shadow: 5px 5px 10px;
		}

		.header-email{
			width: 100%;
			height: auto;
			background: #003068;
			color: white;
			font-weight: bolder;
		}

		.line-header{
			width: 100%;
			height: auto;
			padding-top: 15px;
			padding-bottom: 20px;
		}

		.line-1{
			width: 98%;
			padding-left: 2%;
			font-size: 23px;
		}
		.line-2{
			text-align: center;
		}

		.title-email{
			background: #001935;
			color: white;
			font-weight: bolder;
			text-align: center;
		}

		.data-email,.ttl-email{
			width: 96%;
			padding-left: 2%;
			padding-right: 2%;
		}

		.btn-candidate{
			background: #001935;
			font-weight: bolder;
			color: white;
			padding: 12px;
			border-radius: 7px;
			cursor: pointer;
		}

		.btn-candidate:hover{
			cursor: pointer;
			background: white;
			color: #001935;
			border-color: #001935;
		}
		</style>
		</head>
		<body>
		<div class="content-email">


		<div class="header-email">

		<div class="line-header line-1">
		AOST (Alpha Omega Solutions Travail)</div>

		<div class="line-header line-2">
		NOUVELLE OFFRE D\'EMPLOI DISPONIBLE</div>
		</div>
		<div class="body-email">
		<div class="auto-div-email ttl-email">

		'.$titre.'
		</div>

		<div class="auto-div-email title-email">
		<i>DESCRIPTION</i></div>
		<div class="auto-div-email data-email">
		'.$description.'
		</div>
		<div class="auto-div-email title-email">
		<i>COMPETENCES REQUISES</i></div>
		<div class="auto-div-email data-email">
		'.$competences.'
		</div> 
		<div class="auto-div-email">
		<center><a href="'.$link.'"><button class="btn-candidate">POSTULER MAINTENANT</button></a></center>
		</div>
		</div>
		<div class="footer-email">

		</div>
		</div>
		<body>
		</html>
		';

//Create instance of PHPMailer
		$mail = new PHPMailer();
//Set mailer to use smtp
		$mail->isSMTP();
//Define smtp host
		$mail->Host = 'smtp.gmail.com';
//Enable smtp authentication
		$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
		$mail->SMTPSecure = 'tls';
//Port to connect smtp
		$mail->Port = 587;
//Set gmail username
		$mail->Username = 'pierrekod2@gmail.com';
//Set gmail password
		$mail->Password = 'Matchinda12';
//Email subject
		$mail->Subject = 'Alerte Emploi - AOST';
//Set sender email
		$mail->setFrom('pierrekod2@gmail.com','AOST');
//Enable HTML
		$mail->isHTML(true);
//Email body
		$mail->Body = $message;
//Add recipient
		$mail->addAddress($candidacy_alert->getEmail());
		$mail->addReplyTo('pierrekod2@gmail.com');
//Finally send email
		if ( $mail->send() ) {
			echo "Email Sent..!";
		}else{
			echo "Message could not be sent. Mailer Error: "{$mail->ErrorInfo};
		}
//Closing smtp connection
		$mail->smtpClose();

	}

}






?>