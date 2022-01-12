<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$domain=new Domain($current_domain);

$preview_domain=$domain->getDomain($_POST['id']);

$domain=$domain->getDomain($_POST['id']);

$domain->setId_admin($_SESSION['id']);
$domain->setName($_POST['name']);
$domain->setColor($_POST['color']);


if($domain->editDomain($domain)){

	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin($_SESSION['id']);
	
	$admin->updateLastSeen($_SESSION['id']);

	$current_history=[
		'id'=>0,
		'id_admin'=>$_SESSION['id'],
		'id_target'=>$_POST['id'],
		'action'=>"edit domain",
		'description'=>$admin->getName()." a modifier le domaine ".$preview_domain->getName()." en ".$domain->getName(),
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	$history->addHistory($history);
}








?>