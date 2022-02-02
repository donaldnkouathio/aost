<?php include("../../../outils/php/redirection.php");
  if (isset($_GET["id_offer"])) {

    $offer = $offer->getOffer($_GET["id_offer"]);
    $subdomain = $subdomain->getSubdomain($offer->getId_subdomain());

  	redirection(ucwords(strtolower(htmlspecialchars_decode($subdomain->getName())))." | Alpha Omega Solutions Travail", _APP_PATH."job/offers/about/about.php", "Offres d'emplois", "Offres d'emplois", _ROOT_PATH."job/offers/about/about.css", _ROOT_PATH."job/offers/about/about.js", "/job/offers/a/".htmlspecialchars_decode(str_replace("&amp;", "&", $subdomain->getName()))."/".$offer->getId()."/");

  }else {
    echo "Erreur 404";
  }
?>
