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
	
}








?>