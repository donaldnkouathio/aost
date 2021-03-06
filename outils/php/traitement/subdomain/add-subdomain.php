<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';




$current_subdomain=[
	'id'=>0,
	'id_admin'=>$_SESSION['id'],
	'id_domain'=>$_POST['id_domain'],
	'name'=>$_POST['name'],
	'color'=>$_POST['color'],
	'added_at'=>date("Y-m-d H:i:s")
];


$subdomain=new Subdomain($current_subdomain);

if($subdomain->addSubdomain($subdomain)){

	$last_subdomain=$subdomain->getLastSubdomain();

	$domain=new Domain($current_domain);
	$domain=$domain->getDomain($subdomain->getId_domain());

	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin($_SESSION['id']);

	$admin->updateLastSeen($_SESSION['id']);

	$current_history=[
		'id'=>0,
		'id_admin'=>$_SESSION['id'],
		'id_target'=>$last_subdomain->getId(),
		'action'=>"add subdomain",
		'description'=>ucfirst(htmlspecialchars_decode($admin->getName()))." a ajouté le sous-domaine \" ".ucfirst(htmlspecialchars_decode($subdomain->getName()))." \" dans le domaine ".ucfirst(htmlspecialchars_decode($domain->getName())),
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	$history->addHistory($history);
}








?>
