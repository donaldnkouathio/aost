<h2 class="margin-top-none">Offres d'emploi</h2>

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

<div class="item_container">
  <table>
    <tr>
      <th>No</th>
      <th>Profession</th>
      <th>Entreprise</th>
      <th>Ville</th>
      <th>Mis en ligne</th>
      <th>Actions</th>
    </tr>
  <?php
    $i = 0;
    foreach ($offers as $offer) {

      $city = $city->getCity($offer->getId_city());
      $subdomain = $subdomain->getSubdomain($offer->getId_subdomain());
  ?>
      <tr>
        <td><?php echo $offer->getId(); ?></td>
        <td><?php echo ucfirst($subdomain->getName()); ?></td>
        <td><?php echo ucfirst($offer->getCompagny()); ?></td>
        <td><?php echo ucfirst($city->getName()); ?></td>
        <td><?php echo get_elapsed_time($offer->getAdded_at()); ?></td>
        <td>
          <div class="item_setting">
            <span class="btnEdit" id="btnEdit<?php echo $i; ?>" title="Modifier">
              <i class="material-icons vertical-align-bottom">mode_edit</i>
            </span>
            <span class="btnDelete" id="btnDelete<?php echo $i; ?>" title="Supprimer">
              <i class="material-icons vertical-align-bottom">delete</i>
            </span>
          </div>
        </td>
      </tr>
  <?php
    $i++;
    }
  ?>
  </table>
</div>

<?php if($nombreDePages > 1){ ?>
<div class="breadcrumb-block">
  <div class="breadcrumb-contain">
    <?php if($pageActuelle >  1){ ?>
      <a class="breadcrumb-item" href="<?php echo _DASHBOARD_PATH; ?>offers/p/<?php echo $pageActuelle - 1; ?>"><i class="material-icons vertical-align-bottom"> chevron_left </i></a>
    <?php }for($i = 1; $i < $nombreDePages+1; $i++){
      if($i == $pageActuelle){ ?>
      <span class="breadcrumb-item breadcrumb-item-active"><?php echo $i; ?></span>
    <?php  }else{ ?>
      <a class="breadcrumb-item" href="<?php echo _DASHBOARD_PATH; ?>offers/p/<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php }}if($pageActuelle <= $nombreDePages - 1){ ?>
      <a class="breadcrumb-item" href="<?php echo _DASHBOARD_PATH; ?>offers/p/<?php echo $pageActuelle + 1; ?>"><i class="material-icons vertical-align-bottom"> chevron_right </i></a>
    <?php } ?>
  </div>
</div>
<?php } ?>


<?php
  //Modal for editing
  $i = 0;
  foreach ($offers as $offer) {
  ?>
    <div class="item_modal_shadow" id="editModal<?php echo $i; ?>">
      <div class="item_modal">
        <div class="item_modal_body">
          <?php $admin = $admin->getAdmin($offer->getId_admin()); ?>
          <h3 style="font-weight: normal">Offre d'emploi <strong>No <?php echo $offer->getId(); ?></strong>, ajoutée par <strong><?php echo $admin->getName(); ?></strong> <?php get_elapsed_time($offer->getAdded_at()); ?></h3>

          <div class="item_modal_input">
            <label for="profession<?php echo $i; ?>">profession</label>
            <select class="" name="" id="profession<?php echo $i; ?>">
              <?php
                $domains = $domain->getDomains();
                foreach ($domains as $domain) { ?>
                  <optgroup label="<?php echo ucfirst($domain->getName()); ?>">
              <?php
                  $subdomain_thisOffer = $subdomain->getSubdomain($offer->getId_subdomain());
                  $subdomains = $subdomain->getListSubdomains($domain->getId());
                  foreach ($subdomains as $subdomain) {
              ?>
                <option value="<?php echo $subdomain->getName(); ?>" <?php if(ucwords($subdomain->getName()) == ucwords($subdomain_thisOffer->getName())){echo "selected";} ?>><?php echo ucfirst($subdomain->getName()); ?></option>
              <?php } ?>
                </optgroup>
              <?php } ?>
            </select>
          </div>
          <div class="item_modal_input">
            <label for="city<?php echo $i; ?>">Ville </label>
            <select class="" name="" id="city<?php echo $i; ?>">
              <?php
                  $citys = $city->getCitys();
                  foreach ($citys as $city) {
              ?>
                <option value="<?php echo $city->getId(); ?>" <?php if($city->getId() == $offer->getId_city()){echo "selected";} ?>><?php echo ucfirst($city->getName()); ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="item_modal_input">
              <label for="deadline<?php echo $i; ?>">Expire le </label>
              <input type="date" name="" value="<?php echo date('Y-m-d', strtotime($offer->getDeadline())); ?>"  id="deadline<?php echo $i; ?>">
          </div>
          <div class="item_modal_input">
              <label for="compagny<?php echo $i; ?>">Entreprise </label>
              <input type="text" name="" value="<?php echo $offer->getCompagny(); ?>"  id="compagny<?php echo $i; ?>">
          </div>
          <div class="item_modal_checkbox">
              <input type="checkbox" name="" value=""  id="cv<?php echo $i; ?>" <?php if($offer->getCv() == 1){echo "checked";} ?>>
              <label for="cv<?php echo $i; ?>"> CV obligatoire</label>
          </div>
          <div class="">
              <input type="checkbox" name="" value=""  id="motivation<?php echo $i; ?>" <?php if($offer->getMotivation() == 1){echo "checked";} ?>>
              <label for="motivation<?php echo $i; ?>"> Lettre de motivation obligatoire</label>
          </div>

          <h2 class="margin-bottom-none" title="Description globale de la demande">Description</h2>
          <div class="description<?php echo $i; ?>"></div>

          <h2 class="margin-bottom-none" title="description détaillée (par mission) de la demande">Missions</h2>
          <div class="missions<?php echo $i; ?>"></div>

          <h2 class="margin-bottom-none" title="compétences requises du postulant ">Compétences</h2>
          <div class="skill<?php echo $i; ?>"></div>

          <h2 class="margin-bottom-none" title="Informations requises du postulant (age, annee d'experience, caractere etc...)">Profil</h2>
          <div class="profile<?php echo $i; ?>"></div>
        </div>

        <div class="item_modal_header">
          <div class="item_modal_header_left" id="btnEditConfirm<?php echo $i; ?>">
            Modifier
          </div>
          <div class="item_modal_header_right" id="btnEditClose<?php echo $i;?>" title="Annuler">
            Annuler
          </div>
        </div>
      </div>
    </div>


    <?php // Modal for delete ?>
    <div class="item_deleteModal_shadow" id="deleteModal<?php echo $i; ?>">
      <div class="item_deleteModal">
        <div class="item_deleteModal_body">
          <i class="material-icons">warning</i>
          <span>Voulez vous vraiment supprimer l'orffre d'emploi No <?php echo $offer->getId(); ?> ?</span>
        </div>
        <div class="item_deleteModal_footer">
          <div class="item_deleteModal_left">
            Supprimer
          </div>
          <div class="item_deleteModal_right" id="btnDeleteClose<?php echo $i;?>" title="Annuler">
            Annuler
          </div>
        </div>
      </div>
    </div>
<?php
$i++;
}
?>

<?php // Button for add modal ?>
<span class="btnAdd" id="btnAdd">
  <i class="material-icons vertical-align-bottom" style="font-size : 1em; margin-bottom: 0.2em">add</i>
  <span class="">Ajouter</span>
</span>

<?php // Modal for add ?>
<div class="item_modal_shadow" id="addModal">
  <div class="item_modal">

    <div class="item_modal_body">
      <h3 style="font-weight: normal">Veillez remplir ce formulaire pour ajouter une nouvelle offre d'emploi</h3>

      <div class="item_modal_input">
        <label for="profession">profession</label>
        <select class="" name="" id="profession">
          <?php
            $domains = $domain->getDomains();
            foreach ($domains as $domain) { ?>
              <optgroup label="<?php echo ucfirst($domain->getName()); ?>">
          <?php
              $subdomains = $subdomain->getListSubdomains($domain->getId());
              foreach ($subdomains as $subdomain) {
          ?>
            <option value="<?php echo $subdomain->getName(); ?>" ><?php echo ucfirst($subdomain->getName()); ?></option>
          <?php } ?>
            </optgroup>
          <?php } ?>
        </select>
      </div>
      <div class="item_modal_input">
        <label for="city">Ville </label>
        <select class="" name="" id="city">
          <?php
              $citys = $city->getCitys();
              foreach ($citys as $city) {
          ?>
            <option value="<?php echo $city->getId(); ?>"><?php echo ucfirst($city->getName()); ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="item_modal_input">
          <label for="deadline">Expire le </label>
          <input type="date" name="" value=""  id="deadline">
      </div>
      <div class="item_modal_input">
          <label for="compagny">Entreprise </label>
          <input type="text" name="" value=""  id="compagny">
      </div>
      <div class="item_modal_checkbox">
          <input type="checkbox" name="" value=""  id="cv">
          <label for="cv"> CV obligatoire</label>
      </div>
      <div class="">
          <input type="checkbox" name="" value=""  id="motivation">
          <label for="motivation"> Lettre de motivation obligatoire</label>
      </div>

      <h2 class="margin-bottom-none" title="Description globale de la demande">Description</h2>
      <div class="description"></div>

      <h2 class="margin-bottom-none" title="description détaillée (par mission) de la demande">Missions</h2>
      <div class="missions"></div>

      <h2 class="margin-bottom-none" title="compétences requises du postulant ">Compétences</h2>
      <div class="skill"></div>

      <h2 class="margin-bottom-none" title="Informations requises du postulant (age, annee d'experience, caractere etc...)">Profil</h2>
      <div class="profile"></div>
    </div>

    <div class="item_modal_header">
      <div class="item_modal_header_left" id="btnAddConfirm">
        Ajouter
      </div>
      <div class="item_modal_header_right" id="btnAddClose" title="Annuler">
        Annuler
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){

    function toggleModal(modal, modal_btn, modal_btn_close){
      modal_btn.click(function(){
        modal.fadeIn();
      });
      modal_btn_close.click(function(){
        modal.fadeOut();
      });
    }

    function setTrumbowyg(div, defautTxt){
      div.trumbowyg({
        autogrow: false,
        lang: "fr",
        btns: [['p'],
              ['bold', 'italic', 'strikethrough', 'underline'],
              ['superscript', 'subscript'], ['unorderedList', 'orderedList']]
      });

      if(defautTxt != ""){
        //alert(defautTxt);
        div.trumbowyg('html', defautTxt);
      }
    }
    /* var txt = $(".wysiwyg").trumbowyg('html'); //Syntaxte pour récupérer le rendu HTML
    alert(txt); */
    <?php
      $i = 0;
      foreach ($offers as $offer) { ?>

        toggleModal($("#editModal<?php echo $i;?>"), $("#btnEdit<?php echo $i;?>"), $("#btnEditClose<?php echo $i;?>"));
        toggleModal($("#deleteModal<?php echo $i;?>"), $("#btnDelete<?php echo $i;?>"), $("#btnDeleteClose<?php echo $i;?>"));

        //for edit
        setTrumbowyg($(".description<?php echo $i; ?>"), `<?php echo htmlspecialchars_decode($offer->getDescription()); ?>`);
        setTrumbowyg($(".missions<?php echo $i; ?>"), `<?php echo htmlspecialchars_decode($offer->getMissions()); ?>`);
        setTrumbowyg($(".skill<?php echo $i; ?>"), `<?php echo htmlspecialchars_decode($offer->getSkill()); ?>`);
        setTrumbowyg($(".profile<?php echo $i; ?>"), `<?php echo htmlspecialchars_decode($offer->getCandidate_profile()); ?>`);
    <?php
    $i++;
    }
    ?>

    //for add
    toggleModal($("#addModal"), $("#btnAdd"), $("#btnAddClose"));
    setTrumbowyg($(".description"), ``);
    setTrumbowyg($(".missions"), ``);
    setTrumbowyg($(".skill"), ``);
    setTrumbowyg($(".profile"), ``);
  });
</script>
