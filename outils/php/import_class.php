<?php

include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Admin.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Alert.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Candidacy.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Compagny.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Contact.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Customer.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Domain.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/History.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Offer.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Request.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/Subdomain.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/City.class.php");
include($_SERVER["DOCUMENT_ROOT"]."/aost/class/User.class.php");


$current_user=[
	'id'=>0,
	'email'=>"",
	'password'=>"",
	'profile'=>"",
	'blocked'=>0,
	'token_checked'=>"",
	'verified_at'=>"",
	'added_at'=>""
];




$current_alert=[
	'id'=>0,
	'email'=>"",
	'domain'=>"",
	'name'=>"",
	'first_name'=>"",
	'phone'=>"",
	'city'=>"",
	'about'=>"",
	'cv_file'=>"",
	'added_at'=>""
];


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
	'image'=>"",
	'added_at'=>""
];


$current_subdomain=[
	'id'=>0,
	'id_admin'=>0,
	'id_domain'=>0,
	'name'=>"",
	'color'=>"",
	'image'=>"",
	'added_at'=>""
];


$current_customer=[
	'id'=>0,
	'id_user'=>0,
	'name'=>"",
	'phone_1'=>"",
	'phone_2'=>"",
	'first_name'=>"",
	'date_birth'=>"",
	'country'=>"",
	'city'=>"",
	'address'=>"",
	'sex'=>"",
	'about'=>"",
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


$current_compagny=[
	'id'=>0,
	'id_user'=>0,
	'id_domain'=>0,
	'other_domain'=>"",
	'name'=>"",
	'country'=>"",
	'city'=>"",
	'address'=>"",
	'added_at'=>""
];


$current_candidacy=[
	'id'=>0,
	'id_offer'=>0,
	'id_subdomain'=>0,
	'id_city'=>0,
	'name'=>"",
	'first_name'=>"",
	'phone'=>"",
	'email'=>"",
	'domains'=>"",
	'about'=>"",
	'cv_file'=>"",
	'motivation_file'=>"",
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