<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$history=new History($current_history);
$history=$history->getHistory($_POST['id']);

echo $history->removeHistory($_POST['id']);








?>