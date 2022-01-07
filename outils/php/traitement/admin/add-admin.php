<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$current_admin=[
	'id'=>0,
	'email'=>$_POST['email'],
	'password'=>$_POST['password'],
	'role'=>$_POST['role'],
	'name'=>$_POST['name'],
	'added_at'=>date("Y-m-d H:i:s")
];


$admin=new Admin($current_admin);

if($admin->addAdmin($admin)){

	$last_admin=$admin->getLastAdmin();

	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin($_SESSION['id']);

	$current_history=[
		'id'=>0,
		'id_admin'=>$_SESSION['id'],
		'id_target'=>$last_admin->getId(),
		'action'=>"add admin",
		'description'=>$admin->getName()." a ajouté l'administrateur ".$last_admin->getName()." de role ".$last_admin->getRole(),
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	$history->addHistory($history);
}








?>