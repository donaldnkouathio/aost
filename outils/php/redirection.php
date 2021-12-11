<?php
  session_start();
  require_once $_SERVER["DOCUMENT_ROOT"].'/aost/outils/php/functions.php';

  function redirection($title, $pageContain, $currentPage, $css, $js){
    //$title : titre de la page
    //$pageContain : contenu de la page
    //$currentPage : nom de la page courante
    //$css et $js : finchiers css et js de la page
  ?>

  <?php include($_SERVER["DOCUMENT_ROOT"]."/aost/header/head.php");
    $_SESSION["currentPage"]= $currentPage; //Page actuellement visitée par l'utilisateur
  ?>

  		<title><?php echo $title; ?></title>

      <link rel="stylesheet" href="<?php echo $css; ?>"/>

  	</head>
  	<body>
      <?php include($_SERVER["DOCUMENT_ROOT"]."/aost/header/header.php"); // En tête ?>

      <?php include($_SERVER["DOCUMENT_ROOT"].$pageContain); // Contenu ?>

    	<?php include($_SERVER["DOCUMENT_ROOT"]."/aost/footer/footer.php"); // Pied de page ?>

      <script src="<?php echo $js; ?>"></script>

<?php } ?>
