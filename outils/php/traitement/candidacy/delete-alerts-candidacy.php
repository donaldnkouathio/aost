<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$candidacy=new Candidacy($current_candidacy);

$email=$_GET['email'];

$subdomain=new Subdomain($current_subdomain);

$candidacy->deleteCandidacyAlerts($_GET['email']);

header("Location:"._APP_PATH."/home/index.php");






?>