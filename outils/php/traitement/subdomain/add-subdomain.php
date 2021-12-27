<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';




$current_subdomain=[
	'id'=>0,
	'id_admin'=>$_SESSION['id'],
	'id_domain'=>$_POST['id_domain'],
	'name'=>$_POST['name'],
	'color'=>$_POST['color'],
	'image'=>$_POST['image'],
	'added_at'=>date("Y-m-d H:i:s")
];


$subdomain=new Subdomain($current_subdomain);

if($subdomain->addSubdomain($subdomain)){
	//header("Location:../../../../subdomain-us/index.php?data=sended");
}else{
	//header("Location:../../../../subdomain-us/index.php?data=failed");
}








?>