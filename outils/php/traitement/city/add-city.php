<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$current_city=[
	'id'=>0,
	'name'=>$_POST['name'],
	'added_at'=>date("Y-m-d H:i:s")
];


$city=new City($current_city);

if($city->addCity($city)){

	$last_city=$city->getLastCity();

	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin($_SESSION['id']);

	$admin->updateLastSeen($_SESSION['id']);

	$current_history=[
		'id'=>0,
		'id_admin'=>$_SESSION['id'],
		'id_target'=>$last_city->getId(),
		'action'=>"add city",
		'description'=>ucfirst(htmlspecialchars_decode($admin->getName()))." a ajouté la ville \"".ucfirst(htmlspecialchars_decode($city->getName()))."\"",
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	$history->addHistory($history);
}








?>
