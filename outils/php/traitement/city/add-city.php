<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$current_city=[
	'id'=>0,
	'name'=>$_POST['name'],
	'added_at'=>date("Y-m-d H:i:s")
];


$city=new City($current_city);

if($city->addCity($city)){
	//header("Location:../../../../contact-us/index.php?data=sended");
}else{
	//header("Location:../../../../contact-us/index.php?data=failed");
}








?>