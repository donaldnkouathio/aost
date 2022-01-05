<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$offer=new Offer($current_offer);

$offer=$offer->getOffer($_POST['id']);

$offer->setId_subdomain($_POST['id_subdomain']);
$offer->setId_city($_POST['city']);
$offer->setCompagny($_POST['compagny']);
$offer->setDescription($_POST['description']);
$offer->setMissions($_POST['missions']);
$offer->setSkill($_POST['skill']);
$offer->setCandidate_profile($_POST['candidate_profile']);
$offer->setCv($_POST['cv']);
$offer->setMotivation($_POST['motivation']);
$offer->setExpired($_POST['expired']);
$offer->setDeadline($_POST['deadline']);


if($offer->editOffer($offer)){
	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin(1);

	$subdomain=new Subdomain($current_subdomain);
	$subdomain=$subdomain->getSubdomain($offer->getId_subdomain());

	$current_history=[
		'id'=>0,
		'id_admin'=>1,
		'id_target'=>$offer->getId(),
		'action'=>"edit offer",
		'description'=>$admin->getName()." a modifié une offre dans la catégorie ".$subdomain->getName(),
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	$history->addHistory($history);
}







?>