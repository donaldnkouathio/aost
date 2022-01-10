<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


if($_SESSION['role']=="super"){
	
	$history=new History($current_history);
	echo $history->clearHistory();

}






?>