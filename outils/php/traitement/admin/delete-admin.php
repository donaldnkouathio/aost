<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$admin=new Admin($current_admin);

$admin->updateLastSeen($_SESSION['id']);

$deleted_admin=$admin->getAdmin($_POST['id']);

if($_SESSION['role']=="super"){

	if($admin->removeAdmin($_POST['id'])){

		$admin=$admin->getAdmin($_SESSION['id']);

		$current_history=[
			'id'=>0,
			'id_admin'=>$_SESSION['id'],
			'id_target'=>$_POST['id'],
			'action'=>"delete admin",
			'description'=>ucfirst(htmlspecialchars_decode($admin->getName()))." a supprimé l'administrateur ".ucfirst(htmlspecialchars_decode($deleted_admin->getName()))." de role ".$deleted_admin->getRole(),
			'added_at'=>date("Y-m-d H:i:s")
		];

		$history=new History($current_history);
		echo $history->addHistory($history);
	}

}






?>
