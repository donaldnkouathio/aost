<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$offer=new Offer($current_offer);
$offer=$offer->getOffer($_POST['id']);

if($offer->removeOffer($_POST['id'])){

	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin($_SESSION['id']);

	$admin->updateLastSeen($_SESSION['id']);

	$subdomain=new Subdomain($current_subdomain);
	$subdomain=$subdomain->getSubdomain($offer->getId_subdomain());

	$current_history=[
		'id'=>0,
		'id_admin'=>$_SESSION['id'],
		'id_target'=>$_POST['id'],
		'action'=>"delete offer",
		'description'=>ucfirst(htmlspecialchars_decode($admin->getName()))." a supprimé une offre de la catégorie ".ucfirst(htmlspecialchars_decode($subdomain->getName())),
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	$history->addHistory($history);
}








?>
