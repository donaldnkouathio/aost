<?php
  session_start();
  require_once '../../init.php';
  require_once _APP_PATH.'outils/php/functions.php';
  require_once _APP_PATH.'outils/php/import_class.php';

  if(isset($_POST["email"]) && isset($_POST["password"])){

    $admin = new Admin($current_admin);

    $admin->setEmail($_POST['email']);
    $admin->setPassword($_POST['password']);

    if ($admin->logIn($admin)) {
      //header('location:'.$_POST["current_page"]);
      echo "ok";
    }else {
      //header('location:'.$_POST["current_page"]);
      echo "not";
    }
  }else {
    header('location:/');
  }
?>
