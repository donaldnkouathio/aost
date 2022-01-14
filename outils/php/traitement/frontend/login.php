<?php
session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';

if(isset($_POST["email"]) && isset($_POST["password"])){

  $admin = new Admin($current_admin);
  $session = new Session();

  $admin->setEmail($_POST['email']);
  $admin->setPassword($_POST['password']);

  if ($admin->logIn($admin) == 1) {

    $admin->updateLastSeen($_SESSION["id"]);
    echo "ok";
  }else {
    echo "not found";
  }
}else {
  header('location:/');
}
?>
