<?php
  require_once 'init.php';
  require_once _APP_PATH.'outils/php/functions.php';
  require_once _APP_PATH.'outils/php/Session.class.php';
  require_once _APP_PATH.'outils/php/Posting.class.php';
  require_once _APP_PATH.'outils/php/import_class.php';

  $session = new Session(); // Utilitaire qui va contenir nos variables de session

  $domain = (!isset($domain)) ? new Domain($current_domain) : $domain;
  $subdomain = new Subdomain($current_subdomain);
  $offer = new Offer($current_offer);
  $city = new City($current_city);
  $contact = new Contact($current_contact);

  function redirection($title, $pageContain, $currentPage, $currentSubPage, $css, $js, $link){
    //$title : titre de la page
    //$pageContain : contenu de la page
    //$currentPage : nom de la page courante
    //$currentSubPage : nom de la sous page courante
    //$css et $js : finchiers css et js de la page
  ?>

  <?php
    include(_APP_PATH."header/head.php");

    global $session;

    global $domain;
    global $subdomain;
    global $offer;
    global $city;
    global $contact;

    $session->setCurrentPage($currentPage); //Page actuellement visitée par l'utilisateur
    $session->setCurrentSubPage($currentSubPage); //Page actuellement visitée par l'utilisateur
  ?>
      <?php

        echo '<link rel="canonical" href="https://alphaomegasolutionstravail.ca'.$link.'"/>';

        switch ($currentSubPage) {
          case 'isIndex':
            echo '<meta name="robots" content="Follow">';
            break;
          case 'isHome':
            echo '<meta name="robots" content="noindex">';
            break;

          default:
            echo '<meta name="robots" content="Follow">';
            break;
        }
      ?>

  		<title><?php echo $title; ?></title>

      <link rel="stylesheet" href="<?php echo $css; ?>"/>

  	</head>
  	<body>
      <?php include(_APP_PATH."header/header.php"); // En tête ?>

      <?php $session->preloader(); // Indicateur de chargement des pages
        if($currentPage != "home"){
          $marginTop = "110px";
        }else {
          $marginTop = "70px";
        }
      ?>

      <div class="global_block_page" style="margin-top:<?php echo $marginTop; ?>">
        <?php
          switch ($currentPage) {
            case 'Offres d\'emplois':
              $newCurrentPage = "Emploi";
              break;
            case 'domains':
              $newCurrentPage = "domaines";
              break;
            case 'partners':
              $newCurrentPage = "partenaires";
              break;

            default:
              $newCurrentPage = $currentPage;
              break;
          }

          switch ($currentSubPage) {
            case 'candidates':
              $newCurrentSubPage = "Candidats";
              break;
            case 'prompt-application':
              $newCurrentSubPage = "Candidatures spontanée";
              break;
            case 'hiring-process':
              $newCurrentSubPage = "processus d'embauche";
              break;
            case 'accident':
              $newCurrentSubPage = "En cas d'accident";
              break;
            case 'pay-vacation':
              $newCurrentSubPage = "paies & vaccances";
              break;
            case 't4-releve1':
              $newCurrentSubPage = "t4 et relevé 1";
              break;
            case 'isHome':
              $newCurrentSubPage = "";
              break;
            case 'isIndex':
              $newCurrentSubPage = "";
              break;

            default:
              $newCurrentSubPage = $currentSubPage;
              break;
          }

          if($newCurrentPage != "home"){
        ?>
            <div class="offset-10-laptop current_page_indicator">

            	<span class="margin-right-5">Vous êtes ici :</span>

            	<a href="/"><i class="notranslate  material-icons vertical-align-bottom">home</i></a>

            	<i class="notranslate  material-icons vertical-align-bottom">chevron_right</i>

              <?php echo ucwords(strtolower(htmlspecialchars_decode($newCurrentPage))); } ?>

            	<?php
                if($newCurrentSubPage != ""){
              ?>

              	<i class="notranslate  material-icons vertical-align-bottom">chevron_right</i>

                <?php if(isset($_GET["id_offer"])){ ?>

                  <a href="<?php echo _ROOT_PATH; ?>job/offers/"><?php echo ucwords(strtolower(htmlspecialchars_decode($newCurrentSubPage))); ?></a>

                  <i class="notranslate  material-icons vertical-align-bottom">chevron_right</i>

                  <?php echo ucwords(strtolower(htmlspecialchars_decode($subdomain->getName()))); ?>

                <?php }else{ echo ucwords(strtolower(htmlspecialchars_decode($newCurrentSubPage))); } ?>
              <?php } ?>
        </div>

        <?php include($pageContain); // Contenu ?>
      </div>

      <?php $session->goToTop(); // Indicateur de chargement des pages ?>

      <?php include(_APP_PATH."footer/footer.php"); // Pied de page ?>

      <script src="<?php echo $js; ?>"></script>

<?php } ?>
