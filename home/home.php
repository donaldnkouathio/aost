<div class="container-box" style="background-image: url('<?php echo _ROOT_PATH; ?>img/bg/bg1.jpg');">
  <div class="container-box-shadow">
    <div class="offset-10-laptop container-box-body" style="">
      <div class="container-title"><h1 class="less-size-title">L'agence qui facilite votre recherche d'emploi</h1></div>
      <form method="post" action="<?php echo _ROOT_PATH; ?>job/offers/" class="form-offres-block">
        <div class="input-search">
          <label for="inputSearchInput"></label>
          <input type="text" name="keyword" id="inputSearchInput" autocomplete="off" placeholder="Rechercher un emploi...">

          <!-- Auto Suggest -->
          <div class="autoSuggest-block" autocomplete="off" id="autoSuggest-block">

          </div>
        </div>
        <br>
        <button id="autosuggest-btn" type="submit" class="btn btn-primary" name="button">Rechercher</button>
      </form>
    </div>
  </div>
</div>

<div class="offset-10-laptop about-block">
  <div class="about-contain offset-10-laptop" style="width: 80%">
    <p><strong><span class="notranslate">Alpha Omega Solutions Travail inc.</span> (AOST)</strong> est une agence de recrutement, de formation et de placement
      du personnel pour les entreprises québécoises et canadiennes enregistrées
    sous le NEQ 1173599367 au Registraire des entreprises du Québec.</p>
  </div>
  <div class="about-contain">
    <h2>Que faisons-nous ?</h2>
    <ul>
      <li><i class="notranslate  material-icons vertical-align-bottom"> check_circle </i>	Nous travaillons pour vous trouver les meilleurs employés</li>
      <li><i class="notranslate  material-icons vertical-align-bottom"> check_circle </i>	Nous travaillons pour vous trouver le meilleur emploi</li>
      <li><i class="notranslate  material-icons vertical-align-bottom"> check_circle </i>	Profitez aussi de nos programmes de formation dans votre domaine</li>
      <li><i class="notranslate  material-icons vertical-align-bottom"> check_circle </i>	Emploi pour la diversité et emploi pour tous maintenant</li>
      <li><i class="notranslate  material-icons vertical-align-bottom"> check_circle </i>	Nous travaillons pour le développement du Québec et du Canada</li>
    </ul>
    <a href="#" class="ep-voir-plus">EN SAVOIR PLUS <i class="notranslate  material-icons vertical-align-bottom"> chevron_right </i></a>
  </div>
  <div class="about-contain">
    <h2>Employeurs</h2>
    <ul>
      <li><i class="notranslate  material-icons vertical-align-bottom"> check_circle </i>	<span class="notranslate">Alpha Omega Solutions Travail inc.</span> couvre en tout temps vos besoins en main d’œuvre et en  ressources humaines  que se soit des travailleurs qualifiés ou non</li>
      <li><i class="notranslate  material-icons vertical-align-bottom"> check_circle </i>	Nous  formons nos employés avant de les mettre à votre disposition</li>
      <li><i class="notranslate  material-icons vertical-align-bottom"> check_circle </i>	Un conseiller responsable de secteur d’activité répondra à vos besoins et vos questions</li>
      <li><i class="notranslate  material-icons vertical-align-bottom"> check_circle </i>	Un conseiller vous contactera dès la réception de votre demande de manière à dresser un portrait exhaustif de votre entreprise et de vos besoins</li>
    </ul>
    <a href="<?php echo _ROOT_PATH; ?>partners/" class="ep-voir-plus">EN SAVOIR PLUS <i class="notranslate  material-icons vertical-align-bottom"> chevron_right </i></a>
  </div>
  <br>
</div>

<div class="container-box" style="background-image: url('<?php echo _ROOT_PATH; ?>img/bg/bg4.jpg');">
  <div class="container-box-shadow">
    <div class="offset-10-laptop container-box-body">
      <div class="container-title container-text_1-title"><h1>Vous cherchez un emploi ? </h1></div>
      <div class="left_right_container">
        <div class="container-text_1 left-block">
          <span>Consultez notre catalogue d'offres d'emploi et postulez</span>
          <a href="<?php echo _ROOT_PATH; ?>job/offers/">catalogue d'offres</a>
        </div>
        <div class="container-text_1 right-block">
          <span>Voulez-Vous que nous trouvons un emploi fait pour vous ?<br> Envoyez-nous votre CV</span>
          <a href="<?php echo _ROOT_PATH; ?>job/prompt-application/" class="">Candidature spontanée</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="offers-container">
  <div class="offset-10-laptop emplois-populaires">
    <h2 class="margin-top-none">Les emplois populaires</h2>

    <div class="emplois-populaires-container">
      <?php
      $offers = $offer->getOffersFromLast(4);

      foreach ($offers as $offer) {
        $city = $city->getCity($offer->getId_city());

        $subdomain = $subdomain->getSubdomain($offer->getId_subdomain());
        $domain = $domain->getDomain($subdomain->getId_domain());
        $domainColor = $domain->getColor()==""? "66BFDE" : $domain -> getColor();
        ?>
        <a href="<?php echo _ROOT_PATH."job/offers/a/".str_replace(" ", "-",$subdomain->getName())."/".$offer->getId()."/" ?>" class="ep-block" style="border-left : 3px solid #<?php echo $domainColor; ?>">
          <div class="ep-text">
            <span class="ep-id">Offre No <?php echo $offer->getId(); ?></span>
            <span class="ep-title"><?php echo $subdomain->getName(); ?></span>
            <span class="ep-city"><i class="notranslate  material-icons vertical-align-bottom">location_on</i><?php echo $city->getName(); ?></span>
            <span class="ep-added_at"><i class="notranslate  material-icons vertical-align-bottom"> today </i><?php echo get_elapsed_time($offer->getAdded_at()); ?></span>
          </div>
        </a>
      <?php } ?>
    </div>

    <a href="<?php echo _ROOT_PATH; ?>job/offers/" class="ep-voir-plus">VOIR TOUS LES EMPLOIS DISPONIBLES <i class="notranslate  material-icons vertical-align-bottom"> chevron_right </i></a>
  </div>
</div>
