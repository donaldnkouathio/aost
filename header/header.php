<header>
  <nav class="nav-container offset-10-laptop" style="">
    <div class="nav-logo" style="">
      <img src="<?php echo _ROOT_PATH; ?>img/logo.jpg" alt="logo AOST">
    </div>

    <ul class="nav-contain-left hide-on-mobile" style="">
      <li><a href="<?php echo _ROOT_PATH; ?>" class="<?php if($utility->getCurrentPage()=="home"){echo "link-hover";} ?>">Accueil</a></li>
      <li class="<?php if($utility->getCurrentPage()=="Offres d'emplois"){echo "link-hover";} ?>">
        <span>Emploi <i class="material-icons vertical-align-bottom"> keyboard_arrow_down </i></span>

        <ul>
          <li><a href="<?php echo _ROOT_PATH; ?>job/offers" class="<?php if($utility->getCurrentSubPage()=="Offres d'emplois"){echo "sub-link-hover";} ?>">Offres d'emploi</a></li>
          <li><a href="#">Candidats</a></li>
          <li><a href="<?php echo _ROOT_PATH; ?>job/prompt-application" class="<?php if($utility->getCurrentSubPage()=="prompt-application"){echo "sub-link-hover";} ?>">Candidature spontanée</a></li>
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
            $domaineTab= ["Informatique", "Ressources humaines humaines","Education", "Ressources humaines humaines","Education", "Informatique", "Sécurité", "Ressources humaines", "Ressources humaines","Education"];
            $imgTab= ["dom", "dom2","dom", "dom2", "dom", "dom2", "dom","dom2", "dom","dom2"];
            for($i=0; $i<10; $i++){
          ?>
            <a href="#" class="domain-block" style="background-image: url('<?php echo _ROOT_PATH; ?>img/domain/<?php echo $imgTab[$i]; ?>.jpg')">
              <div><?php echo $domaineTab[$i].""; ?></div>
            </a>
          <?php } ?>

        </ul>
      </li>
      <li>Partenaires</li>
      <li class="<?php if($utility->getCurrentPage()=="contactez-nous"){echo "sub-link-hover";} ?>">
        Contactez nous <i class="material-icons vertical-align-bottom"> keyboard_arrow_down </i>
        <ul>
          <li><a href="<?php echo _ROOT_PATH; ?>contact-us/contact-us" class="<?php if($utility->getCurrentSubPage()=="contactez-nous"){echo "sub-link-hover";} ?>">Contactez-nous</a></li>
          <li><a href="#">Informez nous de tout changement</a></li>
        </ul>
      </li>
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
        <li><a href="<?php echo _ROOT_PATH; ?>" class="<?php if($utility->getCurrentPage()=="home"){echo "link-mobile-hover";} ?>">Accueil</a></li>

        <li id="subNavEmploiBtn"><a  class="<?php if($utility->getCurrentPage()=="Offres d'emplois"){echo "link-mobile-hover";} ?>">
          Emploi
          <i class="material-icons vertical-align-bottom" style="float:right"> chevron_right </i>
        </a></li>

        <li id="subNavDomainesBtn"><a>
          Domaines
          <i class="material-icons vertical-align-bottom" style="float:right"> chevron_right </i>
        </a></li>

        <li><a href="#">Partenaires</a></li>

        <li id="subNavContactBtn"><a class="<?php if($utility->getCurrentPage()=="contactez-nous"){echo "link-mobile-hover";} ?>">
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
        <li><a href="<?php echo _ROOT_PATH; ?>job/offers" class="<?php if($utility->getCurrentSubPage()=="Offres d'emplois"){echo "link-mobile-hover";} ?>">Offres d'emploi</a></li>
        <li><a href="#">Candidats</a></li>
        <li><a href="<?php echo _ROOT_PATH; ?>job/prompt-application" class="<?php if($utility->getCurrentSubPage()=="prompt-application"){echo "link-mobile-hover";} ?>">Candidature spontanée</a></li>
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
        <span style="margin-left: 15px;">Domaines</span>
      </div>
      <ul class="nav-mobile-body">
        <li><a href="#">Informatique</a></li>
        <li><a href="#">Ressources humaines</a></li>
        <li><a href="#">Education</a></li>
        <li><a href="#">Sécurité</a></li>
      </ul>
    </div>

    <!-- Sous menu -Contactez-nous- pour mobile -->
    <div class="nav-mobile" id="subNavContact">
      <div class="nav-mobile-header" style="">
        <i class="material-icons vertical-align-bottom cursor-pointer" id="subNavContactBtnClose"> chevron_left </i>
        <span style="margin-left: 15px;">Contactez-nous</span>
      </div>
      <ul class="nav-mobile-body">
        <li><a href="<?php echo _ROOT_PATH; ?>contact-us/contact-us/" class="<?php if($utility->getCurrentSubPage()=="contactez-nous"){echo "link-mobile-hover";} ?>">Contactez-nous</a></li>
        <li><a href="#">Informez nous de tout changement</a></li>
      </ul>
    </div>

  </nav>
</header>
