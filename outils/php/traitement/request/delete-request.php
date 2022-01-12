<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$request=new Request($current_request);

$admin=new Admin($current_admin);
$admin->updateLastSeen($_SESSION['id']);

$request=$request->removeRequest($_POST['id']);








?>