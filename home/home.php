<div class="container-box" style="background-image: url('/aost/img/bg/bg1.jpg');">
  <div class="container-box-shadow">
    <div class="offset-10-laptop container-box-body" style="">
      <div class="container-title">L'agence qui facilite votre recherche d'emploi</div>
      <form method="post" action="<?php echo _ROOT_PATH; ?>job/offers/" class="form-offres-block">
        <div class="input-search">
          <input type="text" name="keyword" id="inputSearchInput" autocomplete="off" placeholder="Chercher un emploi...">

          <!-- Auto Suggest -->
          <div class="autoSuggest-block" autocomplete="off" id="autoSuggest-block">

          </div>
        </div>
        <br>
        <button id="autosuggest-btn" type="submit" class="btn btn-primary" name="button">Chercher</button>
      </form>
    </div>
  </div>
</div>

<div class="offset-10-laptop about-block">
  <div class="about-contain">
    <p><strong>Alpha Omega Solutions Travail inc. (AOST)</strong> est une agence de recrutement, de formation et de placement
      du personnel pour les entreprises québécoises et canadiennes enregistrée
    sous le NEQ 1173599367 au Registraire des entreprises du Québec.</p>
  </div>
  <div class="about-contain">
    <h2>Que faisons-nous ?</h2>
    <ul>
      <li><i class="material-icons vertical-align-bottom"> check_circle </i>	Nous travaillons pour vous trouver les meilleurs employés</li>
      <li><i class="material-icons vertical-align-bottom"> check_circle </i>	Nous travaillons pour vous trouver le meilleur emploi</li>
      <li><i class="material-icons vertical-align-bottom"> check_circle </i>	Profitez aussi de nos programmes de formation dans votre domaine</li>
      <li><i class="material-icons vertical-align-bottom"> check_circle </i>	Emploi pour la diversité et emploi pour tous maintenant</li>
      <li><i class="material-icons vertical-align-bottom"> check_circle </i>	Nous travaillons pour le développement du Québec et du Canada</li>
    </ul>
    <a href="#" class="ep-voir-plus">EN SAVOIR PLUS <i class="material-icons vertical-align-bottom"> chevron_right </i></a>
  </div>
  <div class="about-contain">
    <h2>Employeurs</h2>
    <ul>
      <li><i class="material-icons vertical-align-bottom"> check_circle </i>	Alpha Omega Solutions Travail inc. couvre en tout temps vos besoins en main d’œuvre et en  ressources humaines  que se soit des travailleurs qualifiés ou non</li>
      <li><i class="material-icons vertical-align-bottom"> check_circle </i>	Nous  formons nos employés avant de les mettre à votre disposition</li>
      <li><i class="material-icons vertical-align-bottom"> check_circle </i>	Un conseiller responsable de secteur d’activité répondra à vos besoins et vos questions</li>
      <li><i class="material-icons vertical-align-bottom"> check_circle </i>	Un conseiller vous contactera dès réception de votre demande de manière à dresser un portrait exhaustif de votre entreprise et de vos besoins</li>
    </ul>
    <a href="<?php echo _ROOT_PATH; ?>partners/" class="ep-voir-plus">EN SAVOIR PLUS <i class="material-icons vertical-align-bottom"> chevron_right </i></a>
  </div>
  <br>
</div>

<div class="container-box" style="background-image: url('/aost/img/bg/bg4.jpg');">
  <div class="container-box-shadow">
    <div class="offset-10-laptop container-box-body">
      <div class="container-title container-text_1-title">Vous chercher de l'emploi ? </div>
      <div class="left_right_container">
        <div class="container-text_1 left-block">
          <span>Consultez notre catalogue d'offres d'emploi et postulez</span>
          <a href="<?php echo _ROOT_PATH; ?>job/offers/">catalogue d'offres</a>
        </div>
        <div class="container-text_1 right-block">
          <span>Ou vous voules simplement nous faire parvenir votre CV</span>
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
      $offers = $offer->getOffers();

      foreach ($offers as $offer) {
        $city = $city->getCity($offer->getId_city());

        $domain = $domain->getDomain($offer->getId_domain());
        $domainColor = $domain->getColor()==""? "66BFDE" : $domain -> getColor();
        ?>
        <a href="<?php echo _ROOT_PATH."job/offers/a/".str_replace(" ", "-",$offer->getProfession())."/".$offer->getId()."/" ?>" class="ep-block" style="border-left : 3px solid #<?php echo $domainColor; ?>">
          <div class="ep-icon">
            <span>icon</span>
          </div>
          <div class="ep-text">
            <span class="ep-title"><?php echo $offer->getProfession(); ?></span>
            <span class="ep-city"><i class="material-icons vertical-align-bottom">location_on</i><?php echo $city->getName(); ?></span>
            <span class="ep-added_at"><i class="material-icons vertical-align-bottom"> today </i><?php echo get_elapsed_time($offer->getAdded_at()); ?></span>
          </div>
        </a>
      <?php } ?>
    </div>

    <a href="<?php echo _ROOT_PATH; ?>job/offers/" class="ep-voir-plus">VOIR TOUS LES EMPLOIS DISPONIBLE <i class="material-icons vertical-align-bottom"> chevron_right </i></a>
  </div>
</div>
