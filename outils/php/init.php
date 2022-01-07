<?php
/*  ini_set( 'display_errors', 'Off' );

  // security, checked by essential files under subdir
  define('_SECURE_', 1);

  // generate a unique Process ID
  define('_PID_', uniqid('PID'));

  $core_config['daemon_process'] = $DAEMON_PROCESS;

  if (!$core_config['daemon_process']) {
  if (trim($SERVER_PROTOCOL)=="HTTP/1.1") {
    header ("Cache-Control: no-cache, must-revalidate");
  } else {
    header ("Pragma: no-cache");
  }
  @session_start();
  ob_start();
}*/

  //Chemins par defaut du projet;
$root_path = $_SERVER["DOCUMENT_ROOT"]."aost/";
  define('_APP_PATH', $root_path); // Pour les liens PHP
  define('_ROOT_PATH', "/aost/"); // Pour les liens HTML, JS et CSS
  ?>
