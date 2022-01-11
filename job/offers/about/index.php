<?php include("../../../outils/php/redirection.php");
  if (isset($_GET["id"])) {

    $offer = $offer->getOffer($_GET["id"]);
    $subdomain = $subdomain->getSubdomain($offer->getId_subdomain());

  	redirection($subdomain->getName()." | Alpha Omega Solutions Travail", _APP_PATH."job/offers/about/about.php", "Offres d'emplois", "Offres d'emplois", _ROOT_PATH."job/offers/about/about.css", _ROOT_PATH."job/offers/about/about.js");

  }else {
    echo "Erreur 404";
  }
?>
