<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';

$deadline=date('Y-m-d H:i:s', strtotime('+ 2 MONTH'));

if(isset($_POST['deadline']) && !empty($_POST['deadline'])){
	$deadline=$_POST['deadline']." ".date('H:i:s');
}


$current_offer=[
	'id'=>0,
	'id_admin'=>1,
	'id_subdomain'=>$_POST['id_subdomain'],
	'id_city'=>$_POST['city'],
	'compagny'=>$_POST['compagny'],
	'description'=>$_POST['description'],
	'missions'=>$_POST['missions'],
	'skill'=>$_POST['skill'],
	'candidate_profile'=>$_POST['candidate_profile'],
	'cv'=>$_POST['cv'],
	'motivation'=>$_POST['motivation'],
	'deleted'=>0,
	'expired'=>0,
	'deadline'=>$deadline,
	'added_at'=>date("Y-m-d H:i:s")
];

$offer=new Offer($current_offer);

if($offer->addOffer($offer)){

	$last_offer=$offer->getLastOffer();

	$admin=new Admin($current_admin);
	$admin=$admin->getAdmin(1);

	$subdomain=new Subdomain();
	$subdomain=$subdomain->getSubdomain($offer->getId_subdomain());

	$current_history=[
		'id'=>0,
		'id_admin'=>1,
		'id_target'=>$last_offer->getId(),
		'action'=>"add offer",
		'description'=>$admin->getName()." a ajouté une offre dans la catégorie ".$subdomain->getName(),
		'added_at'=>date("Y-m-d H:i:s")
	];

	$history=new History($current_history);
	$history->addHistory($history);

}






?>