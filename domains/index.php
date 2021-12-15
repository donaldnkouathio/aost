<?php
	include($_SERVER["DOCUMENT_ROOT"]."/aost/outils/php/redirection.php");
	if(isset($_GET['domain'])){

		$session->setCurrentDomain(str_replace("-", " ", $_GET["domain"]));

		redirection($session->getCurrentDomain()." | Alpha Omega Solutions Travail", _APP_PATH."domains/domains.php", "domains", $session->getCurrentDomain(), _ROOT_PATH."domains/domains.css", _ROOT_PATH."domains/domains.js");
	}else {
		echo "erreur 404 Page pas trouvés";
	}
?>
