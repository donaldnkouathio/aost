<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$subdomain=new Subdomain($current_subdomain);

$subdomain=$subdomain->getSubdomain($_POST['id']);

$subdomain->setId_admin($_SESSION['id']);
$subdomain->setName($_POST['name']);
$subdomain->setColor($_POST['color']);
$subdomain->setImage($_POST['image']);


echo $subdomain->editSubdomain($subdomain);








?>