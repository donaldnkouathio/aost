<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$admin=new Admin($current_admin);

$admin=$admin->getAdmin($_POST['id']);

$admin->setEmail($_POST['email']);
$admin->setRole($_POST['role']);
$admin->setName($_POST['name']);

$admin->editAdmin($admin);

if($_SESSION['id'] == $admin->getId()){
  $_SESSION['email']=$admin->getEmail();
  $_SESSION['role']=$admin->getRole();
  $_SESSION['name']=$admin->getName();
}








?>
