<?php
  session_start();
  require_once 'init.php';
  require_once _APP_PATH.'outils/php/functions.php';
  require_once _APP_PATH.'outils/php/Utility.class.php';

  $utility = new Utility(); // Utilitaire qui va contenir nos variables de session

  function redirection($title, $pageContain, $currentPage, $currentSubPage, $css, $js){
    //$title : titre de la page
    //$pageContain : contenu de la page
    //$currentPage : nom de la page courante
    //$currentSubPage : nom de la sous page courante
    //$css et $js : finchiers css et js de la page
  ?>

  <?php
    include(_APP_PATH."header/head.php");

    global $utility;

    $utility->setCurrentPage($currentPage); //Page actuellement visitée par l'utilisateur
    $utility->setCurrentSubPage($currentSubPage); //Page actuellement visitée par l'utilisateur
  ?>

  		<title><?php echo $title; ?></title>

      <link rel="stylesheet" href="<?php echo $css; ?>"/>

  	</head>
  	<body>
      <?php include(_APP_PATH."header/header.php"); // En tête ?>

      <?php include($pageContain); // Contenu ?>

    	<?php include(_APP_PATH."footer/footer.php"); // Pied de page ?>

      <script src="<?php echo $js; ?>"></script>

<?php } ?>
