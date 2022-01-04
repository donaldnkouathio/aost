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


echo $offer->editOffer($offer);







?>