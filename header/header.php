<header>
  <nav class="nav-container offset-10-laptop" style="">
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
            <a href="#" class="domain-block" style="background-image: url('/aost/img/domain/<?php echo $imgTab[$i]; ?>.jpg')">
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
      <li class="hide-on-laptop" id="navMobileBtn"><i class="material-icons vertical-align-bottom"> menu </i></li>
      <li class="hide-on-mobile">S'inscrire</li>
      <li class="hide-on-mobile">Se connecter</li>
    </ul>

    <!-- Menu pour mobile -->
    <div class="nav-mobile" id="navMobile" style="">
      <div class="nav-mobile-header" style="">
        Menu
        <i class="material-icons vertical-align-bottom cursor-pointer" id="navMobileBtnClose" style="float:right"> close</i>
      </div>
      <ul class="nav-mobile-body">
        <li><a href="#">Accueil</a></li>

        <li id="subNavEmploiBtn"><a>
          Emploi
          <i class="material-icons vertical-align-bottom" style="float:right"> chevron_right </i>
        </a></li>

        <li id="subNavDomainesBtn"><a>
          Domaines
          <i class="material-icons vertical-align-bottom" style="float:right"> chevron_right </i>
        </a></li>

        <li><a href="#">Partenaires</a></li>

        <li><a href="#">
          Contactez-nous
          <i class="material-icons vertical-align-bottom" style="float:right"> chevron_right </i>
        </a></li>

        <li><a href="#">
          A propos de nous
          <i class="material-icons vertical-align-bottom" style="float:right"> chevron_right </i>
        </a></li>

        <li><a href="#">S'inscrire</a></li>
        <li><a href="#">Se connecter</a></li>
      </ul>
    </div>

    <!-- Sous menu -Emploi- pour mobile -->
    <div class="nav-mobile" id="subNavEmploi">
      <div class="nav-mobile-header" style="">
        <i class="material-icons vertical-align-bottom cursor-pointer" id="subNavEmploiBtnClose"> chevron_left </i>
        <span style="margin-left: 15px;">Emploi</span>
      </div>
      <ul class="nav-mobile-body">
        <li><a href="#">Offres d'emploi</a></li>
        <li><a href="#">Candidat</a></li>
        <li><a href="#">Candidature spontanée</a></li>
        <li><a href="#">Processus d'embauche</a></li>
        <li><a href="#">Accidents</a></li>
        <li><a href="#">Paies & vaccances</a></li>
        <li><a href="#">T4 & Relevé</a></li>
      </ul>
    </div>

    <!-- Sous menu -Domaines- pour mobile -->
    <div class="nav-mobile" id="subNavDomaines">
      <div class="nav-mobile-header" style="">
        <i class="material-icons vertical-align-bottom cursor-pointer" id="subNavDomainesBtnClose"> chevron_left </i>
        <span style="margin-left: 15px;">Emploi</span>
      </div>
      <ul class="nav-mobile-body">
        <li><a href="#">Informatique</a></li>
        <li><a href="#">Ressources humaines</a></li>
        <li><a href="#">Education</a></li>
        <li><a href="#">Sécurité</a></li>
      </ul>
    </div>

  </nav>
</header>
