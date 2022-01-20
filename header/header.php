<header>
  <nav class="nav-container offset-10-laptop translate" style="">
    <div class="nav-logo" style="">
      <a href="<?php echo _ROOT_PATH; ?>">
        <img src="<?php echo _ROOT_PATH; ?>img/logo.png" alt="logo AOST">
      </a>
      <span class="notranslate presentation_tablette">Alpha Omega Solutions Travail</span>
      <span class="notranslate presentation_mobile">AOST</span>
    </div>

    <ul class="nav-contain-left hide-on-mobile" style="">
      <li><a href="<?php echo _ROOT_PATH; ?>" class="<?php if($session->getCurrentPage()=="home"){echo "link-hover";} ?> nav-link">Accueil</a></li>
      <li>
        <a href="#" class="<?php if($session->getCurrentPage()=="Offres d'emplois"){echo "link-hover";} ?> nav-link">Emplois <i class="notranslate  material-icons vertical-align-bottom"> keyboard_arrow_down </i></a>

        <ul class="job-block">
          <li><a href="<?php echo _ROOT_PATH; ?>job/offers" class="<?php if($session->getCurrentSubPage()=="Offres d'emplois"){echo "sub-link-hover";} ?>">Offres d'emploi</a></li>
          <li><a href="<?php echo _ROOT_PATH; ?>job/candidates" class="<?php if($session->getCurrentSubPage()=="candidates"){echo "sub-link-hover";} ?>">Candidats</a></li>
          <li><a href="<?php echo _ROOT_PATH; ?>job/prompt-application" class="<?php if($session->getCurrentSubPage()=="prompt-application"){echo "sub-link-hover";} ?>">Candidature spontanée</a></li>
          <li><a href="<?php echo _ROOT_PATH; ?>job/hiring-process" class="<?php if($session->getCurrentSubPage()=="hiring-process"){echo "sub-link-hover";} ?>">Processus d'embauche</a></li>
          <li><a href="<?php echo _ROOT_PATH; ?>job/accident" class="<?php if($session->getCurrentSubPage()=="accident"){echo "sub-link-hover";} ?>">En cas d'accident</a></li>
          <li><a href="<?php echo _ROOT_PATH; ?>job/pay-vacation" class="<?php if($session->getCurrentSubPage()=="pay-vacation"){echo "sub-link-hover";} ?>">Paies & vaccances</a></li>
          <li><a href="<?php echo _ROOT_PATH; ?>job/t4-releve1" class="<?php if($session->getCurrentSubPage()=="t4-releve1"){echo "sub-link-hover";} ?>">T4 & Relevé 1</a></li>
        </ul>
      </li>
      <li>
        <a href="#" class="<?php if($session->getCurrentPage()=="domains"){echo "link-hover";} ?> nav-link">Domaines <i class="notranslate  material-icons vertical-align-bottom"> keyboard_arrow_down </i></a>

        <ul>
          <?php
          $domains = $domain->getDomains();
          foreach ($domains as $domain) {
            $domainColor = $domain->getColor()==""? "66BFDE" : $domain -> getColor();
            ?>
            <a href="<?php echo _ROOT_PATH; ?>domains/<?php echo (str_replace(" ", "-", ucfirst(htmlspecialchars_decode($domain->getName()))))."/".$domain->getId(); ?>" class="domain-block <?php if($session->getCurrentSubPage()==ucfirst(htmlspecialchars_decode($domain->getName()))){echo "sub-link-hover";} ?>" style="border-left : 3px solid #<?php echo $domainColor; ?>">
              <span><?php echo ucfirst(htmlspecialchars_decode($domain->getName())); ?></span>
            </a>
          <?php } ?>

        </ul>
      </li>
      <li><a href="<?php echo _ROOT_PATH; ?>partners/" class="<?php if($session->getCurrentPage()=="partners"){echo "link-hover";} ?> nav-link">Partenaires</a></li>
      <li><a href="<?php echo _ROOT_PATH; ?>contact-us/" class="<?php if($session->getCurrentPage()=="contactez-nous"){echo "link-hover";} ?> nav-link">Contactez nous</a></li>
      <li><a href="#" class=" nav-link">A propos de nous <i class="notranslate  material-icons vertical-align-bottom"> keyboard_arrow_down </i></a></li>
    </ul>

    <ul class="nav-contain-right" style="">
      <li id="google_translate_element" class="btn-google-translate"></li>
      <li class="hide-on-laptop" id="navMobileBtn"><i class="notranslate  material-icons vertical-align-bottom"> menu </i></li>
    </ul>

    <!-- Menu pour mobile -->
    <div class="nav-mobile" id="navMobile" style="">
      <div class="nav-mobile-header" style="">
        Menu
        <i class="notranslate  material-icons vertical-align-bottom cursor-pointer" id="navMobileBtnClose" style="float:right"> close</i>
      </div>
      <ul class="nav-mobile-body">
        <li><a href="<?php echo _ROOT_PATH; ?>" class="<?php if($session->getCurrentPage()=="home"){echo "link-mobile-hover";} ?>">Accueil</a></li>

        <li id="subNavEmploiBtn"><a href="#" class="<?php if($session->getCurrentPage()=="Offres d'emplois"){echo "link-mobile-hover";} ?>">
          Emploi
          <i class="notranslate  material-icons vertical-align-bottom" style="float:right"> chevron_right </i>
        </a></li>

        <li id="subNavDomainesBtn"><a href="#" class="<?php if($session->getCurrentPage()=="domains"){echo "link-mobile-hover";} ?>">
          Domaines
          <i class="notranslate  material-icons vertical-align-bottom" style="float:right"> chevron_right </i>
        </a></li>

        <li><a href="<?php echo _ROOT_PATH; ?>partners/" class="<?php if($session->getCurrentSubPage()=="partners"){echo "link-mobile-hover";} ?>">Partenaires</a></li>

        <li><a href="<?php echo _ROOT_PATH; ?>contact-us/" class="<?php if($session->getCurrentPage()=="contactez-nous"){echo "link-mobile-hover";} ?>">
          Contactez-nous
        </a></li>

        <li><a href="#">
          A propos de nous
          <i class="notranslate  material-icons vertical-align-bottom" style="float:right"> chevron_right </i>
        </a></li>

      </ul>
    </div>

    <!-- Sous menu -Emploi- pour mobile -->
    <div class="nav-mobile" id="subNavEmploi">
      <div class="nav-mobile-header" style="">
        <i class="notranslate  material-icons vertical-align-bottom cursor-pointer" id="subNavEmploiBtnClose"> chevron_left </i>
        <span style="margin-left: 15px;">Emploi</span>
      </div>
      <ul class="nav-mobile-body">
        <li><a href="<?php echo _ROOT_PATH; ?>job/offers" class="<?php if($session->getCurrentSubPage()=="Offres d'emplois"){echo "link-mobile-hover";} ?>">Offres d'emploi</a></li>
        <li><a href="<?php echo _ROOT_PATH; ?>job/candidates" class="<?php if($session->getCurrentSubPage()=="candidates"){echo "link-mobile-hover";} ?>">Candidats</a></li>
        <li><a href="<?php echo _ROOT_PATH; ?>job/prompt-application" class="<?php if($session->getCurrentSubPage()=="prompt-application"){echo "link-mobile-hover";} ?>">Candidature spontanée</a></li>
        <li><a href="<?php echo _ROOT_PATH; ?>job/hiring-process" class="<?php if($session->getCurrentSubPage()=="hiring-process"){echo "link-mobile-hover";} ?>">Processus d'embauche</a></li>
        <li><a href="<?php echo _ROOT_PATH; ?>job/accident" class="<?php if($session->getCurrentSubPage()=="accident"){echo "link-mobile-hover";} ?>">En cas d'accidents</a></li>
        <li><a href="<?php echo _ROOT_PATH; ?>job/pay-vacation" class="<?php if($session->getCurrentSubPage()=="pay-vacation"){echo "link-mobile-hover";} ?>">Paies & vaccances</a></li>
        <li><a href="<?php echo _ROOT_PATH; ?>job/t4-releve1" class="<?php if($session->getCurrentSubPage()=="t4-releve1"){echo "link-mobile-hover";} ?>">T4 & Relevé 1</a></li>
      </ul>
    </div>

    <!-- Sous menu -Domaines- pour mobile -->
    <div class="nav-mobile" id="subNavDomaines">
      <div class="nav-mobile-header" style="">
        <i class="notranslate  material-icons vertical-align-bottom cursor-pointer" id="subNavDomainesBtnClose"> chevron_left </i>
        <span style="margin-left: 15px;">Domaines</span>
      </div>
      <ul class="nav-mobile-body">
        <?php
        $domains = $domain->getDomains();
        foreach ($domains as $domain) {
          $domainColor = $domain->getColor()==""? "66BFDE" : $domain -> getColor();
          ?>
          <li><a href="<?php echo _ROOT_PATH; ?>domains/<?php echo (str_replace(" ", "-", ucfirst(htmlspecialchars_decode($domain->getName()))))."/".$domain->getId(); ?>" class="<?php if($session->getCurrentSubPage()==ucfirst(htmlspecialchars_decode($domain->getName()))){echo "link-mobile-hover";} ?>">
            <?php echo ucfirst(htmlspecialchars_decode($domain->getName())); ?>
          </a></li>
        <?php } ?>
      </ul>
    </div>
  </nav>


</header>




<!-- Debut du code du traducteur de site Web de Google -->
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement(
    {
      pageLanguage: 'fr',
      includedLanguages: 'fr,en',
      multilanguagePage: true,
      autoDisplay: false
    },
    'google_translate_element'
    );
  }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<!-- Fin du code du traducteur de site Web de Google -->
