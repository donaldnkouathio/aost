<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$domain=new Domain($current_domain);

$deleted_domain=$domain->getDomain($_POST['id']);

if($domain->removeDomain($_POST['id'])){


	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin($_SESSION['id']);

	$admin->updateLastSeen($_SESSION['id']);

	$current_history=[
		'id'=>0,
		'id_admin'=>$_SESSION['id'],
		'id_target'=>$_POST['id'],
		'action'=>"delete domain",
		'description'=>ucfirst(htmlspecialchars_decode($admin->getName()))." a supprimé le domaine \" ".ucfirst(htmlspecialchars_decode($deleted_domain->getName()))." \"",
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	$history->addHistory($history);
}








?>
