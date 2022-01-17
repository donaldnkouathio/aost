<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$contact=new Contact($current_contact);

$preview_contact=$contact->getContact($_POST['id']);

$contact=$contact->getContact($_POST['id']);

$contact->setRole($_POST['role']);
$contact->setEmail($_POST['email']);
$contact->setName($_POST['name']);
$contact->setPhone($_POST['phone']);

if($contact->editContact($contact)){

	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin($_SESSION['id']);

	$admin->updateLastSeen($_SESSION['id']);

	$current_history=[
		'id'=>0,
		'id_admin'=>$_SESSION['id'],
		'id_target'=>$_POST['id'],
		'action'=>"edit contact",
		'description'=>ucfirst(htmlspecialchars_decode($admin->getName()))." a modifié les informations du contact ".ucfirst(htmlspecialchars_decode($preview_contact->getName())),
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	$history->addHistory($history);
}








?>
