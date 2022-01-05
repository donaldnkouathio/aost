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

ech $contact->addContact($contact);








?>