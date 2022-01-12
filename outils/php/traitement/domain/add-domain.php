<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';




$current_domain=[
	'id'=>0,
	'id_admin'=>$_SESSION['id'],
	'name'=>$_POST['name'],
	'color'=>$_POST['color'],
	'added_at'=>date("Y-m-d H:i:s")
];


$domain=new Domain($current_domain);

if($domain->addDomain($domain)){

	$last_domain=$domain->getLastDomain();

	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin($_SESSION['id']);
	
	$admin->updateLastSeen($_SESSION['id']);

	$current_history=[
		'id'=>0,
		'id_admin'=>$_SESSION['id'],
		'id_target'=>$last_domain->getId(),
		'action'=>"add domain",
		'description'=>$admin->getName()." a ajouté le domaine \" ".$domain->getName()." \"",
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	$history->addHistory($history);
}








?>