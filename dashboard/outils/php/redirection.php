<?php
  session_start();
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
  $admin = new Admin($current_admin);

  function redirection($title, $pageContain, $currentPage, $currentSubPage, $css, $js){
    //$title : titre de la page
    //$pageContain : contenu de la page
    //$currentPage : nom de la page courante
    //$currentSubPage : nom de la sous page courante
    //$css et $js : finchiers css et js de la page
  ?>

  <?php
    include(_DASHBOARD_PHP_PATH."nav/head.php");

    global $session;

    global $domain;
    global $subdomain;
    global $offer;
    global $city;
    global $admin;

    $session->setCurrentPage($currentPage); //Page actuellement visitée par l'utilisateur
    $session->setCurrentSubPage($currentSubPage); //Page actuellement visitée par l'utilisateur
  ?>

  		<title><?php echo $title; ?> - Dashboard - Alpha Omega Solutions Travail</title>

      <link rel="stylesheet" href="<?php echo $css; ?>"/>

  	</head>
  	<body>
      <?php include(_DASHBOARD_PHP_PATH."nav/nav.php"); // En tête ?>

      <?php $session->preloader(); // Indicateur de chargement des pages ?>

      <div class="dashbord_item" style="">
        <?php  // Contenu
          if(isset($_SESSION["email"])){
            include($pageContain);
          }else {
            include(_DASHBOARD_PHP_PATH."login/index.php");
          }
        ?>
      </div>

      <?php //$session->goToTop(); // Indicateur de chargement des pages ?>

      <?php include(_DASHBOARD_PHP_PATH."footer/footer.php"); // Pied de page ?>

      <script src="<?php echo $js; ?>"></script>

<?php } ?>
