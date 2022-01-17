<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$city=new City($current_city);

$preview_city=$city->getCity($_POST['id']);

$city=$city->getCity($_POST['id']);

$city->setName($_POST['name']);

if($city->editCity($city)){

	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin($_SESSION['id']);

	$admin->updateLastSeen($_SESSION['id']);

	$current_history=[
		'id'=>0,
		'id_admin'=>$_SESSION['id'],
		'id_target'=>$_POST['id'],
		'action'=>"edit city",
		'description'=>ucfirst(htmlspecialchars_decode($admin->getName()))." a modifié la ville \"".ucfirst(htmlspecialchars_decode($preview_city->getName()))."\" en ".ucfirst(htmlspecialchars_decode($city->getName())),
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	$history->addHistory($history);
}








?>
