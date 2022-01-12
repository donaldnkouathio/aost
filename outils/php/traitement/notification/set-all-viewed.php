<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$notification=new notification($current_notification);

$notification=$notification->getNotification($_POST['id']);


if($notification->setAllNotificationsViewed()){

	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin($_SESSION['id']);
	
	$admin->updateLastSeen($_SESSION['id']);
}








?>