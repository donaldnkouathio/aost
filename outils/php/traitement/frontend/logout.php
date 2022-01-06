<?php
  session_start();
  require_once '../../init.php';
  require_once _APP_PATH.'outils/php/functions.php';
  require_once _APP_PATH.'outils/php/import_class.php';

  $admin = new Admin($current_admin);

  $admin->logOut();

  echo "ok";

?>
