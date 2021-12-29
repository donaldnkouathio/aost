<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';




$current_domain=[
	'id'=>0,
	'id_admin'=>$_SESSION['id'],
	'name'=>$_POST['name'],
	'color'=>$_POST['color'],
	'image'=>$_POST['image'],
	'added_at'=>date("Y-m-d H:i:s")
];


$domain=new Domain($current_domain);

if($domain->addDomain($domain)){
	//header("Location:../../../../domain-us/index.php?data=sended");
}else{
	//header("Location:../../../../domain-us/index.php?data=failed");
}








?>