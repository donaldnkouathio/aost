<header>
  <nav class="nav-container" style="">
    <div class="nav-logo" style="">
      <img src="/aost/img/logo.jpg" alt="logo AOST">
    </div>

    <ul class="nav-contain-left hide-on-mobile" style="">
      <li><a href="/aost/" class="<?php if($_SESSION["currentPage"]="home"){echo "link-hover";} ?>">Accueil</a></li>
      <li>
        <span>Emploi <i class="material-icons vertical-align-bottom"> keyboard_arrow_down </i></span>

        <ul>
          <li><a href="#">Offres d'emploi</a></li>
          <li><a href="#">Candidat</a></li>
          <li><a href="#">Candidature spontanée</a></li>
          <li><a href="#">Processus d'embauche</a></li>
          <li><a href="#">Accidents</a></li>
          <li><a href="#">Paies & vaccances</a></li>
          <li><a href="#">T4 & Relevé</a></li>
        </ul>
      </li>

      <li>
        <span>Domaines <i class="material-icons vertical-align-bottom"> keyboard_arrow_down </i></span>

        <ul>
          <?php
            $domaineTab= ["Informatique", "Ressources humaines humaines","Education", "Informatique", "Sécurité", "Ressources humaines", "Ressources humaines","Education"];
            $imgTab= ["dom", "dom2","dom", "dom2", "dom", "dom2", "dom","dom2"];
            for($i=0; $i<8; $i++){
          ?>
            <a href="#" class="domain-block" style="background-image: url('/aost/img/<?php echo $imgTab[$i]; ?>.jpg')">
              <div><?php echo $domaineTab[$i].""; ?></div>
            </a>
          <?php } ?>

        </ul>
      </li>
      <li>Partenaires</li>
      <li>Contactez nous <i class="material-icons vertical-align-bottom"> keyboard_arrow_down </i></li>
      <li>A propos de nous <i class="material-icons vertical-align-bottom"> keyboard_arrow_down </i></li>
    </ul>

    <ul class="nav-contain-right" style="">
      <li class="hide-on-laptop">Menu</li>
      <li class="hide-on-mobile">S'inscrire</li>
      <li class="hide-on-mobile">Se connecter</li>
    </ul>

  </nav>
</header>
