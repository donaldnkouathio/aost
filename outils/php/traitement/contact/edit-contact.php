<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$contact=new Contact($current_contact);

$contact=$contact->getContact($_POST['id']);

$contact->setRole($_POST['role']);
$contact->setEmail($_POST['email']);
$contact->setName($_POST['name']);
$contact->setPhone($_POST['phone']);

if($contact->editContact($contact)){
	//header("Location:../../../../contact-us/index.php?data=sended");
}else{
	//header("Location:../../../../contact-us/index.php?data=failed");
}








?>