<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


if($_SESSION['role']=="super"){

	$current_admin=[
		'id'=>0,
		'email'=>$_POST['email'],
		'password'=>$_POST['password'],
		'role'=>$_POST['role'],
		'name'=>$_POST['name'],
		'last_seen'=>date("Y-m-d H:i:s"),
		'added_at'=>date("Y-m-d H:i:s")
	];



	$admin=new Admin($current_admin);

	$admin->updateLastSeen($_SESSION['id']);

	if($admin->addAdmin($admin)){

		$last_admin=$admin->getLastAdmin();

		$admin=new Admin($current_admin);
		$admin=$admin->getAdmin($_SESSION['id']);

		$current_history=[
			'id'=>0,
			'id_admin'=>$_SESSION['id'],
			'id_target'=>$last_admin->getId(),
			'action'=>"add admin",
			'description'=>ucfirst(htmlspecialchars_decode($admin->getName()))." a ajouté l'administrateur ".ucfirst(htmlspecialchars_decode($last_admin->getName()))." de role ".ucfirst(htmlspecialchars_decode($last_admin->getRole())),
			'added_at'=>date("Y-m-d H:i:s")
		];

		$history=new History($current_history);
		echo $history->addHistory($history);
	}

}



?>
