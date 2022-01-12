<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';



$current_contact=[
	'id'=>0,
	'role'=>$_POST['role'],
	'email'=>$_POST['email'],
	'name'=>$_POST['name'],
	'phone'=>$_POST['phone'],
	'added_at'=>date("Y-m-d H:i:s")
];

$contact=new Contact($current_contact);

if($contact->addContact($contact)){

	$last_contact=$contact->getLastContact();

	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin($_SESSION['id']);
	
	$admin->updateLastSeen($_SESSION['id']);

	$current_history=[
		'id'=>0,
		'id_admin'=>$_SESSION['id'],
		'id_target'=>$last_contact->getId(),
		'action'=>"add contact",
		'description'=>$admin->getName()." a ajouté un nouveau contact de role ".$contact->getRole(),
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	$history->addHistory($history);
}








?>