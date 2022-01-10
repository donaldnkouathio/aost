<?php

include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Admin.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Candidacy.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Contact.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Domain.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/History.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Offer.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Request.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Subdomain.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/City.class.php");


$current_request=[
	'id'=>0,
	'compagny'=>"",
	'email'=>"",
	'city'=>"",
	'compagny_type'=>"",
	'person'=>"",
	'phone'=>"",
	'fax_phone'=>"",
	'need'=>"",
	'deleted'=>0,
	'added_at'=>""
];


$current_offer=[
	'id'=>0,
	'id_admin'=>0,
	'id_subdomain'=>0,
	'id_city'=>0,
	'compagny'=>0,
	'description'=>"",
	'missions'=>"",
	'skill'=>"",
	'candidate_profile'=>"",
	'cv'=>0,
	'motivation'=>0,
	'deleted'=>0,
	'expired'=>0,
	'deadline'=>"",
	'added_at'=>""
];


$current_history=[
	'id'=>0,
	'id_admin'=>0,
	'id_target'=>0,
	'action'=>"",
	'description'=>"",
	'added_at'=>""
];


$current_domain=[
	'id'=>0,
	'id_admin'=>0,
	'name'=>"",
	'color'=>"",
	'added_at'=>""
];


$current_subdomain=[
	'id'=>0,
	'id_admin'=>0,
	'id_domain'=>0,
	'name'=>"",
	'color'=>"",
	'added_at'=>""
];


$current_contact=[
	'id'=>0,
	'role'=>"",
	'email'=>"",
	'name'=>"",
	'phone'=>"",
	'added_at'=>""
];


$current_candidacy=[
	'id'=>0,
	'id_offer'=>0,
	'id_subdomain'=>0,
	'city'=>0,
	'name'=>"",
	'first_name'=>"",
	'phone'=>"",
	'email'=>"",
	'domains'=>"",
	'about'=>"",
	'cv_file'=>"",
	'motivation_file'=>"",
	'alert'=>0,
	'deleted'=>0,
	'added_at'=>""
];


$current_admin=[
	'id'=>0,
	'email'=>"",
	'password'=>"",
	'role'=>"",
	'name'=>"",
	'added_at'=>""
];


$current_city=[
	'id'=>0,
	'name'=>"",
	'added_at'=>""
];












?>