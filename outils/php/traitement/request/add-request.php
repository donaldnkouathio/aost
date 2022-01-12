<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$current_request=[
	'id'=>0,
	'compagny'=>$_POST['compagny'],
	'email'=>$_POST['email'],
	'city'=>$_POST['city'],
	'compagny_type'=>$_POST['compagny_type'],
	'person'=>$_POST['person'],
	'phone'=>$_POST['phone'],
	'fax_phone'=>$_POST['fax_phone'],
	'need'=>$_POST['need'],
	'deleted'=>0,
	'added_at'=>date("Y-m-d H:i:s")
];


$request=new Request($current_request);

if($request->addRequest($request)){

	$last_request=$request->getLastRequest();

	$current_notification=[
		'id'=>0,
		'id_target'=>$last_request->getId(),
		'type'=>"request",
		'viewed'=>0,
		'added_at'=>date("Y-m-d H:i:s")
	];

	$notification=new Notification($current_notification);
	$notification->addNotification($notification);
}








?>