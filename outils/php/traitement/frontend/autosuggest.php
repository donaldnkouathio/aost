<?php
  header("Content-Type: text/plain");
  require_once '../../init.php';
  require_once _APP_PATH.'outils/php/functions.php';
  require_once _APP_PATH.'outils/php/import_class.php';

  $offer = new Offer($current_offer);


  $offers = $offer->getOffers();
  $response = "";

  foreach ($offers as $offer) {
    $response .= $offer->getProfession().",";
  }

  echo $response;
?>
