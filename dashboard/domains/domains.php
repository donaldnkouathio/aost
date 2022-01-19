<h2 class="margin-top-none" style="display: inline-block">Domaines</h2>

<?php // Button for add modal ?>
<?php if($_SESSION["role"] != $session->getRole_3()){ ?>
<span class="btnAdd btnAddAdmin" id="btnAddDomain">
  <i class="notranslate  material-icons vertical-align-bottom margin-right-5">add</i>
  <span class="">Ajouter un domaine</span>
</span>
<?php } ?>

<?php
$domains = $domain->getDomains();
?>

<span class="stat" style="display: block">
  <?php
  if(count($domains) > 1){
    echo count($domains)." domaines trouvés";
  }else {
    if(count($domains) > 0){
      echo "Un domaine trouvé";
    }else {
      echo "Aucun domaine trouvé";
    }
  }
  ?>
</span>


<?php // New style for domains show ?>
<div class="suggest_container">
  <?php
    $i= 0;
		foreach ($domains as $domain) {
      if($i%2 != 0){
        $border_color = $domain->getColor() != "" ? "border-right: 3px solid #".$domain->getColor() : "";
      }else {
        $border_color = $domain->getColor() != "" ? "border-left: 3px solid #".$domain->getColor() : "";
      }
	?>
    <div class="suggest_block" style="<?php echo $border_color; ?>">
      <div class="suggest_row">
        <span class="suggest_col">Domaine No <?php echo $domain->getId(); ?></span>
      </div>
      <div class="suggest_row">
        <span class="suggest_title"  style="max-width: 100%; overflow: hidden; height: 1.4em;" title="<?php echo ucfirst(htmlspecialchars_decode($domain->getName())); ?>"> <?php echo ucfirst(htmlspecialchars_decode($domain->getName())); ?></span>
      </div>
      <div class="suggest_row">
        <span class="suggest_col"><i class="notranslate  material-icons vertical-align-bottom margin-right-5 background-primary">today</i><?php echo get_elapsed_time($domain->getAdded_at()); ?></span>

        <div class="suggest_col float-right">
          <?php if($_SESSION["role"] != $session->getRole_3()){ ?>
          <span class="btnEdit" id="btnEditDomain<?php echo $domain->getId(); ?>" title="Modifier cet domaine">
            <i class="notranslate  material-icons vertical-align-bottom">edit</i>
          </span>
          <span class="btnDelete" id="btnDeleteDomain<?php echo $domain->getId(); ?>" title="Supprimer ce domaine">
            <i class="notranslate  material-icons vertical-align-bottom">close</i>
          </span>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php $i++;} ?>
</div>


<?php // Modal for add ?>
<div class="item_modal_shadow" id="addDomainModal">
  <div class="item_modal">
    <div class="item_modal_body">

      <h2 class="margin-top-none">Ajouter un domaine</h2>

      <div class="item_modal_input">
          <label for="name">Nom </label>
          <input type="text" name="" value=""  id="name">
      </div>

      <span class="item_modal_indicator" id="add_domainIndicator"></span>

    </div>
    <div class="item_modal_header">
      <div class="btn btn-primary" id="btnAddDomainConfirm">
        Ajouter
      </div>
      <div class="btn" id="btnAddDomainClose" title="Annuler">
        Annuler
      </div>
    </div>
  </div>
</div>

<?php foreach ($domains as $domain) { ?>
  <input type="hidden" name="" value="<?php echo $domain->getId(); ?>"  id="id<?php echo $domain->getId(); ?>">

  <?php // Modal for Edit ?>
  <div class="item_modal_shadow" id="editDomainModal<?php echo $domain->getId(); ?>">
    <div class="item_modal">
      <div class="item_modal_body">

        <h2 class="margin-top-none">Modifier le domaine No <?php echo $domain->getId(); ?></h2>

        <?php $admin = $admin->getAdmin($domain->getId_admin()); ?>
        <p>
          Ajouté par <?php echo $admin->getName()." ".get_elapsed_time($domain->getAdded_at()); ?>
        </p>

        <div class="item_modal_input">
            <label for="name<?php echo $domain->getId(); ?>">Nom </label>
            <input type="text" name="" value="<?php echo htmlspecialchars_decode($domain->getName()); ?>"  id="name<?php echo $domain->getId(); ?>">
        </div>

        <span class="item_modal_indicator" id="edit_domainIndicator<?php echo $domain->getId(); ?>"></span>

      </div>
      <div class="item_modal_header">
        <div class="btn btn-primary" id="btnEditDomainConfirm<?php echo $domain->getId(); ?>">
          Modifier
        </div>
        <div class="btn" id="btnEditDomainClose<?php echo $domain->getId(); ?>" title="Annuler">
          Annuler
        </div>
      </div>
    </div>
  </div>

  <?php // Modal for delete ?>
  <div class="item_deleteModal_shadow" id="deleteDomainModal<?php echo $domain->getId(); ?>">
    <div class="item_deleteModal">
      <div class="item_deleteModal_body">
        <i class="notranslate  material-icons">warning</i>
        <span>Voulez vous vraiment supprimer le domaine No <?php echo $domain->getId(); ?> ?</span>

      </div>
      <div class="item_deleteModal_footer">
        <div class="btn btn-danger" id="btnDeleteDomainConfirm<?php echo $domain->getId(); ?>">
          Supprimer
        </div>
        <div class="btn" id="btnDeleteDomainClose<?php echo $domain->getId(); ?>" title="Annuler">
          Annuler
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<script type="text/javascript">
  $(document).ready(function(){
  	//Show or hide modal
   function toggleModal(modal, modal_btn, modal_btn_close){
     $(".item_deleteModal").click(function(ev){
       ev.stopPropagation();
     });
     modal_btn.click(function(){
       modal.fadeIn();
     });
     modal_btn_close.click(function(){
       modal.fadeOut();
     });
    }

    //For add domain in DB
		function putInBD(btn, path, id, name, indicator){
			btn.click(function(){
				var id_val = id,
    				name_val = name.val();

        <?php
          //choix de la couleur aléatoire
          $colorTab = ["0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"];
          $color= "";
          $colorFinal= [$colorTab[random_int(0,15)], $colorTab[random_int(0,15)], $colorTab[random_int(0,15)], $colorTab[random_int(0,15)], $colorTab[random_int(0,15)], $colorTab[random_int(0,15)]];

          for($i=0; $i<6; $i++){
            $color = $color."".$colorFinal[$i];
          }
        ?>

        var color_val = id == "" ? "<?php echo $color; ?>" : "";

        if(name_val != ""){
          $.ajax({
  					url: _ROOT_PATH+path,
  					type: "POST",
  					data:	"id="+id_val
                  +"&name="+name_val
                  +"&color="+color_val,
            beforeSend : function(){
              btn.after('<span class="btn btn-primary btn-loading"><span class="loader"></span></span>');
              btn.hide();
            },
  					success : function(ret){
              alert("Effectué avec succès");
  						window.location.reload();
  					}
  				});
        }else {
          indicator.text("Le nom ne doit pas être vide !")
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
            alert("Supprimé avec succès");
						window.location.reload();
					}
				});
			});
		}

    <?php foreach ($domains as $domain) { ?>
      //for delete
      toggleModal($("#deleteDomainModal<?php echo $domain->getId(); ?>"), $("#btnDeleteDomain<?php echo $domain->getId(); ?>"), $("#btnDeleteDomainClose<?php echo $domain->getId(); ?>, #deleteDomainModal<?php echo $domain->getId(); ?>"));

      deleteInBD($("#btnDeleteDomainConfirm<?php echo $domain->getId(); ?>"), "outils/php/traitement/domain/delete-domain.php", $("#id<?php echo $domain->getId(); ?>"));

      //for edit
      toggleModal($("#editDomainModal<?php echo $domain->getId(); ?>"), $("#btnEditDomain<?php echo $domain->getId(); ?>"), $("#btnEditDomainClose<?php echo $domain->getId(); ?>, #editDomainModal<?php echo $domain->getId(); ?>"));

      putInBD($("#btnEditDomainConfirm<?php echo $domain->getId(); ?>"), "outils/php/traitement/domain/edit-domain.php", $("#id<?php echo $domain->getId(); ?>").val(), $("#name<?php echo $domain->getId(); ?>"), $("#edit_domainIndicator<?php echo $domain->getId(); ?>"));
    <?php } ?>

    //for add
    toggleModal($("#addDomainModal"), $("#btnAddDomain"), $("#btnAddDomainClose, #addDomainModal"));

    putInBD($("#btnAddDomainConfirm"), "outils/php/traitement/domain/add-domain.php", "", $("#name"), $("#add_domainIndicator"));
  });
</script>
