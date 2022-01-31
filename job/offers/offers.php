<?php
	//Pour compter le nombre d'offres et déterminer le nombre de sous pages
$keyword = isset($_POST["keyword"]) ? $_POST["keyword"] : "";

$date = isset($_POST["date"]) ? $_POST["date"] : "DESC";

$id_domain = isset($_POST["id_domain"]) ? $_POST["id_domain"] : "-1";

$offers_count = $offer->getOffersFilterLimit($keyword, $id_domain, $date, "");

/* */
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


	// pour les filres
	$offers = $offer->getOffersFilterLimit($keyword, $id_domain, $date, $premiereEntree);
	?>

	<div class="container-box" style="background-image: url('<?php echo _ROOT_PATH; ?>img/bg/bg1.jpg');">
		<div class="container-box-shadow">
			<div class="offset-10-laptop container-box-body" style="">
				<div class="container-title">L'agence qui facilite votre recherche d'emploi</div>
				<form method="post" action="<?php echo _ROOT_PATH; ?>job/offers/" class="form-offres-block">
					<div class="input-search">
						<label for="inputSearchInput"></label>
						<input type="text" name="keyword" class="" id="inputSearchInput" autocomplete="off" placeholder="Rechercher un emploi..." value="<?php if(isset($_POST["keyword"])){echo $_POST["keyword"];} ?>">

						<!-- Auto Suggest -->
						<div class="autoSuggest-block" id="autoSuggest-block">

						</div>
					</div>
					<br>
					<button id="autosuggest-btn" type="submit" class="btn btn-primary" name="button">Rechercher</button>
				</form>
			</div>
		</div>
	</div>

	<div class="offres-block offers-container">
		<div class="offres-stats">
			<span class="stat">
				<?php
				if(count($offers_count) > 1){
					echo count($offers_count)." offres trouvées";
				}else {
					if(count($offers_count) > 0){
						echo "Une offre trouvée";
					}else {
						echo "Aucune offre trouvée";
					}
				}
				?>
			</span>
			<span class=" btn btn-primary filtresBtn hide-on-laptop">Filtres</span>
		</div>

		<div class="offres-filtres">
			<div class="offres-filtres-header">
				Filtres
				<i class="notranslate  material-icons hide-on-laptop vertical-align-bottom cursor-pointer filtresBtnClose float-right"> close</i>
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
						<option value="-1">Tous les domaines</option>
						<?php
						$domains = $domain->getDomains();
						foreach($domains as $domain){
							?>
							<option value="<?php echo $domain->getId(); ?>" <?php if(isset($_POST["id_domain"])){ if($_POST["id_domain"] == $domain->getId()){echo "selected";} } ?>><?php echo ucfirst(htmlspecialchars_decode($domain->getName())); ?></option>
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
					$city = $city->getCity($offer->getId_city());

					$subdomain = $subdomain->getSubdomain($offer->getId_subdomain());
					$domain = $domain->getDomain($subdomain->getId_domain());
					$domainColor = $domain->getColor()==""? "66BFDE" : $domain -> getColor();
					?>
					<a href="<?php echo _ROOT_PATH."job/offers/a/".str_replace(" ", "-",$subdomain->getName())."/".$offer->getId()."/" ?>" class="ep-block" style="border-left : 3px solid #<?php echo $domainColor; ?>">
						<div class="ep-icon">
							<span>icon</span>
						</div>
						<div class="ep-text">
							<span class="ep-id">Offre No <?php echo $offer->getId(); ?></span>
							<span class="ep-title"><?php echo $subdomain->getName(); ?></span>
							<span class="ep-city"><i class="notranslate  material-icons vertical-align-bottom">location_on</i><?php echo $city->getName(); ?></span>
							<span class="ep-added_at"><i class="notranslate  material-icons vertical-align-bottom"> today </i><?php echo get_elapsed_time($offer->getAdded_at()); ?></span>
						</div>
					</a>
				<?php } ?>
			</div>

			<?php if($nombreDePages > 1){ ?>
				<div class="breadcrumb-block">
					<div class="breadcrumb-contain">
						<?php if($pageActuelle >  1){ ?>
							<a class="breadcrumb-item" href="<?php echo _ROOT_PATH; ?>job/offers/p/<?php echo $pageActuelle - 1; ?>"><i class="notranslate  material-icons vertical-align-bottom"> chevron_left </i></a>
						<?php }for($i = 1; $i < $nombreDePages+1; $i++){
							if($i == $pageActuelle){ ?>
								<span class="breadcrumb-item breadcrumb-item-active"><?php echo $i; ?></span>
							<?php  }else{ ?>
								<a class="breadcrumb-item" href="<?php echo _ROOT_PATH; ?>job/offers/p/<?php echo $i; ?>"><?php echo $i; ?></a>
							<?php }}if($pageActuelle <= $nombreDePages - 1){ ?>
								<a class="breadcrumb-item" href="<?php echo _ROOT_PATH; ?>job/offers/p/<?php echo $pageActuelle + 1; ?>"><i class="notranslate  material-icons vertical-align-bottom"> chevron_right </i></a>
							<?php } ?>
						</div>
					</div>
				<?php } ?>

			</div>
		</div>
