<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$admin=new Admin($current_admin);

$admin->updateLastSeen($_SESSION['id']);

$edited_admin=$admin->getAdmin($_POST['id']);

$admin=$admin->getAdmin($_POST['id']);

$admin->setPassword($_POST['password']);



if($admin->editPassword($admin)){

	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin($_SESSION['id']);

	$description = $_SESSION["id"] != $edited_admin->getId() ? ucfirst(htmlspecialchars_decode($admin->getName()))." a modifié le mot de passe de ".ucfirst(htmlspecialchars_decode($edited_admin->getName())) : ucfirst(htmlspecialchars_decode($edited_admin->getName()))." a modifié son mot de passe";

	$current_history=[
		'id'=>0,
		'id_admin'=>$_SESSION['id'],
		'id_target'=>$_POST['id'],
		'action'=>"edit password",
		'description'=>$description,
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	echo $history->addHistory($history);
}



?>
