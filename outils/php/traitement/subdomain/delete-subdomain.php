<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$subdomain=new Subdomain($current_subdomain);

$deleted_subdomain=$subdomain->getSubdomain($_POST['id']);

if($subdomain->removeSubdomain($_POST['id'])){

	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin($_SESSION['id']);
	
	$admin->updateLastSeen($_SESSION['id']);

	$current_history=[
		'id'=>0,
		'id_admin'=>$_SESSION['id'],
		'id_target'=>$_POST['id'],
		'action'=>"delete subdomain",
		'description'=>$admin->getName()." a supprimé le sous-domaine \" ".$deleted_subdomain->getName()." \"",
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	$history->addHistory($history);
}








?>