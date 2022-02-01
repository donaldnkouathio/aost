<?php
	include("../outils/php/redirection.php");
	if(isset($_GET['id'])){

		$domain = new Domain($current_domain);

		$domain = $domain->getDomain($_GET["id"]);

		$session->setCurrentDomain(str_replace("-", " ", ucfirst(htmlspecialchars_decode($domain->getName()))));

		redirection($session->getCurrentDomain()." | Alpha Omega Solutions Travail", _APP_PATH."domains/domains.php", "domains", ucfirst(htmlspecialchars_decode($domain->getName())), _ROOT_PATH."domains/domains.css", _ROOT_PATH."domains/domains.js", "/domains/".htmlspecialchars_decode(str_replace("&amp;", "&", $domain->getName()))."/".$domain->getId());
	}else {
		echo "erreur 404 Page pas trouvés";
	}
?>
