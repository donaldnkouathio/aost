<div class="container-box" style="background-image: url('/aost/img/bg/bg1.jpg');">
  <div class="container-box-shadow">
    <div class="offset-10-laptop container-box-body" style="">
      <div class="container-title">L'agence qui facilite votre recherche d'emploi</div>
      <div class="">
        <input type="text" name="" value="" placeholder="Chercher un emploi...">
        <br>
        <button type="button" class="btn btn-primary" name="button">Chercher</button>
      </div>
    </div>
  </div>
</div>

<div class="offres-block">
  <div class="offres-stats">
    Environ 10 résultats trouvés
  </div>

  <div class="offres-filtres">
    filtres
  </div>
  <div class="offres-contain">

    <div class="emplois-populaires-container">
      <?php
        $bgTab = ["bg5","bg2","bg3","bg5"];
        $posteTab = ["Web master","Mâcon","Soudeur","Développeur web"];
        $domaineTab = ["Informatique", "Construction et métiers spécialisés ", "Construction et métiers spécialisés ", "Informatique"];
        $colorTab = ["red", "blue", "blue", "red"];
        $j=-1;
        for($i=0; $i<10; $i++){
          $j++;
          if($j>=count($bgTab)){
            $j=0;
          }
      ?>
        <a href="#" class="ep-contain">
          <div class="ep-header" style="background-image: url('/aost/img/bg/<?php echo $bgTab[$j]; ?>.jpg')">
            <span class="ep-poste"><?php echo $posteTab[$j]; ?></span>
            <span class="ep-domaine" style="background-color: <?php echo $colorTab[$j]; ?>"><?php echo $domaineTab[$j]; ?></span>
          </div>
          <div class="ep-footer">
            <div class="ep-footer-top">
              <span class="ep-footer-left"><i class="material-icons vertical-align-bottom"> paid </i> 15$/heure</span>
              <span class="ep-footer-right"><i class="material-icons vertical-align-bottom"> watch_later </i> Temps plein</span>
            </div>
            <div class="ep-footer-bottom">
              <span class="ep-footer-left"><i class="material-icons vertical-align-bottom"> location_on </i> Montréal</span>
              <span class="ep-footer-right"><i class="material-icons vertical-align-bottom"> today </i> <?php get_elapsed_time("10-12-2021 10:30"); ?></span>
            </div>
          </div>
        </a>
      <?php } ?>
    </div>

  </div>
</div>
