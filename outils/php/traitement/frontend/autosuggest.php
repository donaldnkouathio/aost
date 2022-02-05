<?php
  header("Content-Type: text/plain");
  require_once '../../init.php';
  require_once _APP_PATH.'outils/php/functions.php';
  require_once _APP_PATH.'outils/php/import_class.php';

  $offer = new Offer($current_offer);
  $subdomain = new Subdomain($current_subdomain);

  $offers = $offer->getOffersGroup();
  $response = "";

  foreach ($offers as $offer) {
    $subdomain = $subdomain->getSubdomain($offer->getId_subdomain());
    $response .= $subdomain->getName().",";
  }

  echo $response;
?>
