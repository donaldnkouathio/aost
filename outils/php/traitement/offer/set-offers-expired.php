<?php


session_start();
require_once '../../init.php';
require_once _APP_PATH.'outils/php/functions.php';
require_once _APP_PATH.'outils/php/Session.class.php';
require_once _APP_PATH.'outils/php/import_class.php';


$offer=new Offer($current_offer);

$ret = $offer->setOffersExpired() ? "Ok" : "none";

echo $ret;


?>
