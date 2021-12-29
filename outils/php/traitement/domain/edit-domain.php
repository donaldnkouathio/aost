<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$domain=new Domain($current_domain);

$domain=$domain->getDomain($_POST['id']);

$domain->setId_admin($_SESSION['id']);
$domain->setName($_POST['name']);
$domain->setColor($_POST['color']);
$domain->setImage($_POST['image']);

if($domain->editDomain($domain)){
	//header("Location:../../../../domain-us/index.php?data=sended");
}else{
	//header("Location:../../../../domain-us/index.php?data=failed");
}








?>