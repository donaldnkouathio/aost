<h2 class="margin-top-none" style="display: inline-block">Offres d'emploi</h2>

<?php // Button for add modal ?>
<span class="btnAdd btnAddAdmin" id="btnAdd">
  <i class="material-icons vertical-align-bottom margin-right-5">add</i>
  <span class="">Ajouter une offre d'emploi</span>
</span>

<?php
	//Pour compter le nombre d'offres et déterminer le nombre de sous pages
$keyword = isset($_POST["keyword"]) ? $_POST["keyword"] : "";

$date = isset($_POST["date"]) ? $_POST["date"] : "DESC";

$id_domain = isset($_POST["id_domain"]) ? $_POST["id_domain"] : "-1";

$offers_count = $offer->getOffersFilterLimit($keyword, $id_domain, $date, "");

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

 <span class="stat" style="display: block">
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

<!--
<div class="">
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
              <i class="material-icons vertical-align-bottom">close</i>
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
-->

<?php // New style for offers show ?>
<div class="suggest_container">
	<?php
  $i = 0;
  foreach ($offers as $offer) {
   $city = $city->getCity($offer->getId_city());
   $subdomain = $subdomain->getSubdomain($offer->getId_subdomain());
   ?>
   <div class="suggest_block">
     <div class="suggest_row">
      <span class="suggest_col">Offre No <?php echo $offer->getId(); ?></span>
    </div>
    <div class="suggest_row">
      <span class="suggest_title"> <?php echo ucfirst($subdomain->getName()); ?></span>
    </div>
    <div class="suggest_row">
      <span class="suggest_col"><i class="material-icons vertical-align-bottom margin-right-5 background-primary">domain</i><?php echo ucfirst($offer->getCompagny()); ?></span>
      <span class="suggest_col float-right"><i class="material-icons vertical-align-bottom margin-right-5 background-primary">location_on</i><?php echo ucfirst($city->getName()); ?></span>
    </div>
    <div class="suggest_row">
      <span class="suggest_col"><i class="material-icons vertical-align-bottom margin-right-5 background-primary">today</i><?php echo get_elapsed_time($offer->getAdded_at()); ?></span>
      <div class="suggest_col float-right">
       <span class="btnEdit" id="btnEdit<?php echo $i; ?>" title="Modifier">
        <i class="material-icons vertical-align-bottom">mode_edit</i>
      </span>
      <span class="btnDelete" id="btnDelete<?php echo $i; ?>" title="Supprimer">
        <i class="material-icons vertical-align-bottom">close</i>
      </span>
    </div>
  </div>
</div>
<?php
$i++; } ?>
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
  //Modal for edit
  $i = 0;
  foreach ($offers as $offer) {
    ?>
    <div class="item_modal_shadow" id="editModal<?php echo $i; ?>">
      <div class="item_modal">
        <div class="item_modal_body">
          <?php $admin = $admin->getAdmin($offer->getId_admin()); ?>
          <h2 style="font-weight: normal">Offre d'emploi <strong>No <?php echo $offer->getId(); ?></strong>, ajoutée par <strong><?php echo $admin->getName(); ?></strong> <?php get_elapsed_time($offer->getAdded_at()); ?></h2>

          <div class="item_modal_input">
            <label for="id_subdomain<?php echo $i; ?>">profession</label>
            <select class="" name="" id="id_subdomain<?php echo $i; ?>">
              <?php
              $domains = $domain->getDomains();
              foreach ($domains as $domain) { ?>
                <optgroup label="<?php echo ucfirst($domain->getName()); ?>">
                  <?php
                  $subdomain_thisOffer = $subdomain->getSubdomain($offer->getId_subdomain());
                  $subdomains = $subdomain->getListSubdomains($domain->getId());
                  foreach ($subdomains as $subdomain) {
                    ?>
                    <option value="<?php echo $subdomain->getId(); ?>" <?php if(ucwords($subdomain->getName()) == ucwords($subdomain_thisOffer->getName())){echo "selected";} ?>><?php echo htmlspecialchars_decode(ucfirst($subdomain->getName())); ?></option>
                  <?php } ?>
                </optgroup>
              <?php } ?>
            </select>
          </div>
          <div class="item_modal_input">
            <label for="id_city<?php echo $i; ?>">Ville </label>
            <select class="" name="" id="id_city<?php echo $i; ?>">
              <?php
              $citys = $city->getCitys();
              foreach ($citys as $city) {
                ?>
                <option value="<?php echo $city->getId(); ?>" <?php if($city->getId() == $offer->getId_city()){echo "selected";} ?>><?php echo htmlspecialchars_decode(ucfirst($city->getName())); ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="item_modal_input">
            <label for="deadline<?php echo $i; ?>">Expire le </label>
            <input type="date" name="" min="<?php echo date('Y-m-d', strtotime('+ 1 DAY'));?>" value="<?php echo date('Y-m-d', strtotime($offer->getDeadline())); ?>"  id="deadline<?php echo $i; ?>">
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

          <h3 class="margin-bottom-none" title="Description globale de la demande">Description</h3>
          <div class="description<?php echo $i; ?>"></div>

          <h3 class="margin-bottom-none" title="description détaillée (par mission) de la demande">Missions</h3>
          <div class="missions<?php echo $i; ?>"></div>

          <h3 class="margin-bottom-none" title="compétences requises du postulant ">Compétences</h3>
          <div class="skill<?php echo $i; ?>"></div>

          <h3 class="margin-bottom-none" title="Informations requises du postulant (age, annee d'experience, caractere etc...)">Profil</h3>
          <div class="candidate_profile<?php echo $i; ?>"></div>

          <input type="hidden" name="id<?php echo $i; ?>" id="id<?php echo $i; ?>" value="<?php echo $offer->getId(); ?>">
        </div>

        <div class="item_modal_header">
          <div class="btn btn-primary" id="btnEditConfirm<?php echo $i; ?>">
            Modifier
          </div>
          <div class="btn" id="btnEditClose<?php echo $i;?>" title="Annuler">
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

          <input type="hidden" name="id<?php echo $i; ?>" id="id<?php echo $i; ?>" value="<?php echo $offer->getId(); ?>">
        </div>
        <div class="item_deleteModal_footer">
          <div class="btn btn-danger" id="btnDeleteConfirm<?php echo $i;?>">
            Supprimer
          </div>
          <div class="btn" id="btnDeleteClose<?php echo $i;?>" title="Annuler">
            Annuler
          </div>
        </div>
      </div>
    </div>
    <?php
    $i++;
  }
  ?>

  <?php // Modal for add ?>
  <div class="item_modal_shadow" id="addModal">
    <div class="item_modal">

      <div class="item_modal_body">
        <h2 style="font-weight: normal">Ajouter une offre d'emploi</h2>

        <div class="item_modal_input">
          <label for="id_subdomain">profession</label>
          <select class="" name="" id="id_subdomain">
            <?php
            $domains = $domain->getDomains();
            foreach ($domains as $domain) { ?>
              <optgroup label="<?php echo ucfirst($domain->getName()); ?>">
                <?php
                $subdomains = $subdomain->getListSubdomains($domain->getId());
                foreach ($subdomains as $subdomain) {
                  ?>
                  <option value="<?php echo $subdomain->getId(); ?>" ><?php echo htmlspecialchars_decode(ucfirst($subdomain->getName())); ?></option>
                <?php } ?>
              </optgroup>
            <?php } ?>
          </select>
        </div>
        <div class="item_modal_input">
          <label for="id_city">Ville </label>
          <select class="" name="" id="id_city">
            <?php
            $citys = $city->getCitys();
            foreach ($citys as $city) {
              ?>
              <option value="<?php echo $city->getId(); ?>"><?php echo htmlspecialchars_decode(ucfirst($city->getName())); ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="item_modal_input">
          <label for="deadline">Expire le (2 mois plutard par défaut)</label>
          <input type="date" name="" min="<?php echo date('Y-m-d', strtotime('+ 1 DAY'));?>" value="<?php echo date('Y-m-d', strtotime('+ 2 MONTH')); ?>"  id="deadline">
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

        <h3 class="margin-bottom-none" title="Description globale de la demande">Description</h3>
        <div class="description"></div>

        <h3 class="margin-bottom-none" title="description détaillée (par mission) de la demande">Missions</h3>
        <div class="missions"></div>

        <h3 class="margin-bottom-none" title="compétences requises du postulant ">Compétences</h3>
        <div class="skill"></div>

        <h3 class="margin-bottom-none" title="Informations requises du postulant (age, annee d'experience, caractere etc...)">Profil</h3>
        <div class="candidate_profile"></div>
      </div>

      <div class="item_modal_header">
        <div class="btn btn-primary" id="btnAddConfirm">
          Ajouter
        </div>
        <div class="btn" id="btnAddClose" title="Annuler">
          Annuler
        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript">
    $(document).ready(function(){
		//Show or hide modal
   function toggleModal(modal, modal_btn, modal_btn_close){
     $(".item_deleteModal, .item_modal").click(function(ev){
       ev.stopPropagation();
     });
     modal_btn.click(function(){
       modal.fadeIn();
     });
     modal_btn_close.click(function(){
       modal.fadeOut();
     });
   }

	 function serializeText(txt){
		 var regex_space = /&nbsp;/ig;
		 txt = txt.replaceAll(regex_space, " ");

		 return txt;
	 }

	  //Set div or textarea to WYSIWYG editor
	  function setTrumbowyg(div, defautTxt){
     div.trumbowyg({
       autogrow: false,
			 semantic: false,
       lang: "fr",
       btns: [['viewHTML','p'],
       ['bold', 'italic', 'strikethrough', 'underline'],
       ['superscript', 'subscript'], ['unorderedList', 'orderedList']]
     });

     if(defautTxt != ""){
	      //alert(defautTxt);
	      div.trumbowyg('html', defautTxt);
	    }
	  }

		//To add or update offer in DB
    function putInBD(btn, path, id, id_subdomain, id_city, compagny, description, mission, skill, candidate_profile, cv, motivation, deleted, expired, deadline){
      btn.click(function(){
        var id_val = id,
        id_subdomain_val = id_subdomain.val(),
        id_city_val = id_city.val(),
        compagny_val = compagny.val(),
        description_val = serializeText(description.trumbowyg('html')),
        mission_val = serializeText(mission.trumbowyg('html')),
        skill_val = serializeText(skill.trumbowyg('html')),
        candidate_profile_val = serializeText(candidate_profile.trumbowyg('html')),
        deleted_val = deleted,
        expired_val = expired,
        deadline_val = deadline.val();

        var cv_val = cv.prop('checked') == true ? 1 : 0,
        motivation_val = motivation.prop('checked') == true ? 1 : 0;

				if(deadline_val != "" && compagny_val != "" && description_val != "" && mission_val != "" && skill_val != "" && candidate_profile_val != ""){
	        $.ajax({
	         url: _ROOT_PATH+path,
	         type: "POST",
	         data:	"id_subdomain="+id_subdomain_val
	         +"&id="+id_val
	         +"&city="+id_city_val
	         +"&compagny="+compagny_val
	         +"&description="+description_val
	         +"&missions="+mission_val
	         +"&skill="+skill_val
	         +"&candidate_profile="+candidate_profile_val
	         +"&cv="+cv_val
	         +"&motivation="+motivation_val
	         +"&deleted="+deleted_val
	         +"&expired="+expired_val
	         +"&deadline="+deadline_val,
					 beforeSend : function(){
             btn.after('<span class="btn btn-primary btn-loading"><span class="loader"></span></span>');
             btn.hide();
           },
	         success : function(ret){
	          window.location.reload();
	        }
	      });
			}else {
				alert("Les champs ne doivent pas être nuls");
			}
      });
    }

		//For delete offer in DB
		function deleteInBD(btn, path, id){
			btn.click(function(){
				var id_val = id.val();

				$.ajax({
					url: _ROOT_PATH+path,
					type: "POST",
					data:	"id="+id_val,
					beforeSend : function(){
            btn.after('<span class="btn btn-danger btn-loading"><span class="loader"></span></span>');
            btn.hide();
          },
					success : function(ret){
						window.location.reload();
					}
				});
			});
		}

    <?php
    $i = 0;
    foreach ($offers as $offer) { ?>
				//for delete
        toggleModal($("#deleteModal<?php echo $i;?>"), $("#btnDelete<?php echo $i;?>"), $("#btnDeleteClose<?php echo $i;?>, .item_deleteModal_shadow"));

        deleteInBD($("#btnDeleteConfirm<?php echo $i; ?>"), "outils/php/traitement/offer/delete-offer.php", $("#id<?php echo $i; ?>"));

        //for edit
        toggleModal($("#editModal<?php echo $i;?>"), $("#btnEdit<?php echo $i;?>"), $("#btnEditClose<?php echo $i;?>, .item_modal_shadow"));

        setTrumbowyg($(".description<?php echo $i; ?>"), `<?php echo htmlspecialchars_decode($offer->getDescription()); ?>`);
        setTrumbowyg($(".missions<?php echo $i; ?>"), `<?php echo htmlspecialchars_decode($offer->getMissions()); ?>`);
        setTrumbowyg($(".skill<?php echo $i; ?>"), `<?php echo htmlspecialchars_decode($offer->getSkill()); ?>`);
        setTrumbowyg($(".candidate_profile<?php echo $i; ?>"), `<?php echo htmlspecialchars_decode($offer->getCandidate_profile()); ?>`);

        putInBD($("#btnEditConfirm<?php echo $i; ?>"), "outils/php/traitement/offer/edit-offer.php", $("#id<?php echo $i; ?>").val(), $("#id_subdomain<?php echo $i; ?>"), $("#id_city<?php echo $i; ?>"), $("#compagny<?php echo $i; ?>"), $(".description<?php echo $i; ?>"), $(".missions<?php echo $i; ?>"), $(".skill<?php echo $i; ?>"), $(".candidate_profile<?php echo $i; ?>"), $("#cv<?php echo $i; ?>"), $("#motivation<?php echo $i; ?>"), "", "", $("#deadline<?php echo $i; ?>"));
        <?php
        $i++;
      }
      ?>

    //for add
    toggleModal($("#addModal"), $("#btnAdd"), $("#btnAddClose, .item_modal_shadow"));

    setTrumbowyg($(".description"), ``);
    setTrumbowyg($(".missions"), ``);
    setTrumbowyg($(".skill"), ``);
    setTrumbowyg($(".candidate_profile"), ``);

    putInBD($("#btnAddConfirm"), "outils/php/traitement/offer/add-offer.php", "0", $("#id_subdomain"), $("#id_city"), $("#compagny"), $(".description"), $(".missions"), $(".skill"), $(".candidate_profile"), $("#cv"), $("#motivation"), "", "", $("#deadline"));
  });
</script>
