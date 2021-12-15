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

<div class="offres-block">
  <div class="offres-stats">
    Environ 10 résultats trouvés
    <span class="float-right btn btn-primary filtresBtn hide-on-laptop">Filtres</span>
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
        $bgTab = ["bg5","bg2","bg3","bg5"];
        $posteTab = ["Web master","Mâcon","Soudeur","Développeur web"];
        $domaineTab = ["Informatique", "Construction et métiers spécialisés ", "Construction et métiers spécialisés ", "Informatique"];
        $colorTab = ["red", "blue", "blue", "red"];

        $actuParPage= 2; // actu par page
        $nombreDePages=ceil(count($domaineTab)/$actuParPage); // nombre total de page
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

        for($i= $premiereEntree; $i < $actuParPage + $premiereEntree; $i++){
      ?>
        <a href="#" class="ep-contain">
          <div class="ep-header" style="background-image: url('/aost/img/bg/<?php echo $bgTab[$i]; ?>.jpg')">
            <span class="ep-poste"><?php echo $posteTab[$i]; ?></span>
            <span class="ep-domaine" style="background-color: <?php echo $colorTab[$i]; ?>"><?php echo $domaineTab[$i]; ?></span>
          </div>
          <div class="ep-footer">
            <div class="ep-footer-top">
              <span class="ep-footer-left"><i class="material-icons vertical-align-bottom"> paid </i> 15$/heure</span>
              <span class="ep-footer-right"><i class="material-icons vertical-align-bottom"> watch_later </i> Temps plein</span>
            </div>
            <div class="ep-footer-bottom">
              <span class="ep-footer-left"><i class="material-icons vertical-align-bottom"> location_on </i> Expire le Montréal</span>
              <span class="ep-footer-right"><i class="material-icons vertical-align-bottom"> today </i> Publié <?php get_elapsed_time("10-12-2021 10:30"); ?></span>
            </div>
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
