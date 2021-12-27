<?php
	//Pour compter le nombre d'offres et déterminer le nombre de sous pages
	if (isset($_POST["keyword"])) { //Si l'utilisateur effectu un tri par mot clé
		if ($_POST["keyword"] != "") { // Si le mot clé n'est pas vide

			if(isset($_POST["id_domain"])){ // Si l'utilisateur effectu un tri
				$offers_count = $offer->getOffersFilterRegex_count($_POST["id_domain"], $_POST["keyword"]);
			}else {
				$offers_count = $offer->getOffersLimitRegex_count($_POST["keyword"]);
			}

		}else{
			if(isset($_POST["id_domain"])){ // Si l'utilisateur effectu un tri
				$offers_count = $offer->getOffersFilter_count($_POST["id_domain"]);
			}else {
				$offers_count = $offer->getOffers();
			}
		}

	}else{
		if(isset($_POST["id_domain"])){ // Si l'utilisateur effectu un tri
			$offers_count = $offer->getOffersFilter_count($_POST["id_domain"]);
		}else {
			$offers_count = $offer->getOffers();
		}
	}


	$actuParPage= 10; // actu par page
	$nombreDePages=ceil(count($offers_count)/$actuParPage); // nombre total de page
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

	if (isset($_POST["keyword"])) { //Si l'utilisateur effectu un tri par mot clé
		if ($_POST["keyword"] != "") { // Si le mot clé n'est pas vide

			if(isset($_POST["id_domain"])){ // Si l'utilisateur effectu un tri
				$offers = $offer->getOffersFilterRegex($_POST["date"], $_POST["id_domain"], $_POST["keyword"], $premiereEntree);
			}else {
				$offers = $offer->getOffersLimitRegex($_POST["keyword"], $premiereEntree);
			}

		}else{
			if(isset($_POST["id_domain"])){ // Si l'utilisateur effectu un tri
				$offers = $offer->getOffersFilter($_POST["date"], $_POST["id_domain"], $premiereEntree);
			}else {
				$offers = $offer->getOffersLimit($premiereEntree);
			}
		}

	}else{
		if(isset($_POST["id_domain"])){ // Si l'utilisateur effectu un tri
			$offers = $offer->getOffersFilter($_POST["date"], $_POST["id_domain"], $premiereEntree);
		}else {
			$offers = $offer->getOffersLimit($premiereEntree);
		}
	}
?>

<div class="container-box" style="background-image: url('/aost/img/bg/bg1.jpg');">
  <div class="container-box-shadow">
    <div class="offset-10-laptop container-box-body" style="">
      <div class="container-title">L'agence qui facilite votre recherche d'emploi</div>
			<form method="post" action="<?php echo _ROOT_PATH; ?>job/offers/" class="form-offres-block">
        <div class="input-search">
          <input type="text" name="keyword" class="" id="inputSearchInput" autocomplete="off" placeholder="Chercher un emploi..." value="<?php if(isset($_POST["keyword"])){echo $_POST["keyword"];} ?>">

          <!-- Auto Suggest -->
          <div class="autoSuggest-block" id="autoSuggest-block">

          </div>
        </div>
        <br>
        <button id="autosuggest-btn" type="submit" class="btn btn-primary" name="button">Chercher</button>
      </form>
    </div>
  </div>
</div>

<div class="offres-block offers-container">
  <div class="offres-stats">
    <span class="stat">
			<?php
				if(count($offers_count) > 1){
					echo count($offers_count)." offres trouvés";
				}else {
					if(count($offers_count) > 0){
						echo "Une offre trouvé";
					}else {
						echo "Aucune offres trouvé";
					}
				}
			?>
		</span>
    <span class=" btn btn-primary filtresBtn hide-on-laptop">Filtres</span>
  </div>

  <div class="offres-filtres">
    <div class="offres-filtres-header">
      Filtres
      <i class="material-icons hide-on-laptop vertical-align-bottom cursor-pointer filtresBtnClose float-right"> close</i>
    </div>
    <form method="post" action="<?php echo _ROOT_PATH; ?>job/offers/" class="offres-filtres-body">
      <div class="input-block">
      	<label for="date">Trier par date </label>
				<select class="" name="date" id="date">
					<option value="DESC" <?php if(isset($_POST["date"])){ if($_POST["date"] == "DESC"){echo "selected";} } ?>>décroissant</option>
					<option value="ASC" <?php if(isset($_POST["date"])){ if($_POST["date"] == "ASC"){echo "selected";} } ?>>Croissant</option>
				</select>
      </div>
			<div class="input-block">
				<label for="domain">Domain </label>
				<select class="" id="domain" name="id_domain">
					<option value="0">Tous les domaines</option>
					<?php
						$domains = $domain->getDomains();
						foreach($domains as $domain){
					?>
					<option value="<?php echo $domain->getId(); ?>" <?php if(isset($_POST["id_domain"])){ if($_POST["id_domain"] == $domain->getId()){echo "selected";} } ?>><?php echo $domain->getName(); ?></option>
					<?php } ?>
				</select>
			</div>

			<?php if(isset($_POST["keyword"])){ ?>
			<input type="hidden" class="inputSearchInput" name="keyword" value="<?php echo $_POST["keyword"]; ?>">
			<?php } ?>

			<input type="submit" name="" class="btn btn-primary" value="Filtrer">
    </form>
  </div>

  <div class="offres-contain">
    <div class="emplois-populaires-container">
      <?php

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
