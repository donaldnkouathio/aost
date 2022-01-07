<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$subdomain=new Subdomain($current_subdomain);

$preview_subdomain=$subdomain->getSubdomain($_POST['id']);

$subdomain=$subdomain->getSubdomain($_POST['id']);

$subdomain->setId_admin($_SESSION['id']);
$subdomain->setId_domain($_POST['id_domain']);
$subdomain->setName($_POST['name']);
$subdomain->setColor($_POST['color']);
$subdomain->setImage($_POST['image']);


if($subdomain->editSubdomain($subdomain){

	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin($_SESSION['id']);

	$current_history=[
		'id'=>0,
		'id_admin'=>$_SESSION['id'],
		'id_target'=>$_POST['id'],
		'action'=>"edit subdomain",
		'description'=>$admin->getName()." a modifier le domaine ".$preview_subdomain->getName()." en ".$subdomain->getName(),
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	$history->addHistory($history);
}








?>
