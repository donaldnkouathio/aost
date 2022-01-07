<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$admin=new Admin($current_admin);

$deleted_admin=$admin->getAdmin($_POST['id']);

$admin=$admin->getAdmin($_POST['id']);

$admin->setEmail($_POST['email']);
$admin->setRole($_POST['role']);
$admin->setName($_POST['name']);

if($admin->editAdmin($admin)){


  if($_SESSION['id'] == $admin->getId()){
    $_SESSION['email']=$admin->getEmail();
    $_SESSION['role']=$admin->getRole();
    $_SESSION['name']=$admin->getName();
  }


  $admin=new Admin($current_admin);
  $admin=$admin->getAdmin($_SESSION['id']);

  $current_history=[
    'id'=>0,
    'id_admin'=>$_SESSION['id'],
    'id_target'=>$_POST['id'],
    'action'=>"edit admin",
    'description'=>$admin->getName()." a modifier les informations de ".$deleted_admin->getName(),
    'added_at'=>date("Y-m-d H:i:s")
  ];

  $history=new History($current_history);
  $history->addHistory($history);
}









?>
