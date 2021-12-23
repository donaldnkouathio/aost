<?php
	$offers = $offer->getOffers();
?>

<div class="container-box" style="background-image: url('/aost/img/bg/bg1.jpg');">
  <div class="container-box-shadow">
    <div class="offset-10-laptop container-box-body" style="">
      <div class="container-title">L'agence qui facilite votre recherche d'emploi</div>
      <div class="form-offres-block">
        <div class="input-search">
          <input type="text" id="inputSearchInput" placeholder="Chercher un emploi...">

          <!-- Auto Suggest -->
          <div class="autoSuggest-block" id="autoSuggest-block">

          </div>
        </div>

        <br>
        <button type="button" class="btn btn-primary" name="button">Chercher</button>
      </div>
    </div>
  </div>
</div>

<div class="offres-block offers-container">
  <div class="offres-stats">
    Environ <?php echo count($offers); ?> résultats trouvés
    <span class=" btn btn-primary filtresBtn hide-on-laptop">Filtres</span>
  </div>

  <div class="offres-filtres">
    <div class="offres-filtres-header">
      Filtres
      <i class="material-icons hide-on-laptop vertical-align-bottom cursor-pointer filtresBtnClose float-right"> close</i>
    </div>
    <div class="offres-filtres-body">
      azertyu
    </div>
  </div>

  <div class="offres-contain">
    <div class="emplois-populaires-container">
      <?php
        $actuParPage= 10; // actu par page
        $nombreDePages=ceil(count($offers)/$actuParPage); // nombre total de page
        if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
        {
           $pageActuelle=intval($_GET['page']);

           if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
           {
                $pageActuelle=$nombreDePages;
           }
        }
        else // Sinon
        {
           $pageActuelle=1; // La page actuelle est la n°1
        }

        $premiereEntree=($pageActuelle-1)*$actuParPage; // On calcule la première entrée à lire

        foreach ($offers as $offer) {

          $domain = $domain->getDomain($offer->getId_domain());
          $domainColor = $domain->getColor()==""? "66BFDE" : $domain -> getColor();
        ?>
        <a href="<?php echo _ROOT_PATH."job/offers/a/".str_replace(" ", "-",$offer->getProfession())."/".$offer->getId()."/" ?>" class="ep-block" style="border-left : 3px solid #<?php echo $domainColor; ?>">
          <div class="ep-icon">
            <span>icon</span>
          </div>
          <div class="ep-text">
            <span class="ep-title"><?php echo $offer->getProfession(); ?></span>
            <span class="ep-city"><i class="material-icons vertical-align-bottom">location_on</i><?php echo $offer->getCity(); ?></span>
            <span class="ep-added_at"><i class="material-icons vertical-align-bottom"> today </i><?php echo get_elapsed_time($offer->getAdded_at()); ?></span>
          </div>
        </a>
      <?php } ?>
    </div>

    <?php if($nombreDePages > 1){ ?>
    <div class="breadcrumb-block">
      <div class="breadcrumb-contain">
        <?php if($pageActuelle >  1){ ?>
          <a class="breadcrumb-item" href="<?php echo _ROOT_PATH; ?>job/offers/p/<?php echo $pageActuelle - 1; ?>"><i class="material-icons vertical-align-bottom"> chevron_left </i></a>
        <?php }for($i = 1; $i < $nombreDePages+1; $i++){
          if($i == $pageActuelle){ ?>
          <span class="breadcrumb-item breadcrumb-item-active"><?php echo $i; ?></span>
        <?php  }else{ ?>
          <a class="breadcrumb-item" href="<?php echo _ROOT_PATH; ?>job/offers/p/<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php }}if($pageActuelle <= $nombreDePages - 1){ ?>
          <a class="breadcrumb-item" href="<?php echo _ROOT_PATH; ?>job/offers/p/<?php echo $pageActuelle + 1; ?>"><i class="material-icons vertical-align-bottom"> chevron_right </i></a>
        <?php } ?>
      </div>
    </div>
    <?php } ?>

  </div>
</div>
