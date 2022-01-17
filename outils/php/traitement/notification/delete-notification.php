<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';

$session = new Session();

if($_SESSION['role']==$session->getRole_1()){

	$notification=new Notification($current_notification);


	$admin=new Admin($current_admin);
	$admin->updateLastSeen($_SESSION['id']);

	echo $notification->removeNotification($_POST['id']);

}







?>
