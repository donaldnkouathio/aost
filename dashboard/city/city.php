<h2 class="margin-top-none" style="display: inline-block">Villes</h2>

<?php // Button for add modal ?>
<span class="btnAdd btnAddAdmin" id="btnAdd">
  <i class="material-icons vertical-align-bottom margin-right-5">add</i>
  <span class="">Ajouter une ville</span>
</span>

<?php
$cities = $city->getCitys();
?>

<span class="stat" style="display: block">
  <?php
  if(count($cities) > 1){
    echo count($cities)." villes trouvées";
  }else {
    if(count($cities) > 0){
      echo "Un ville trouvée";
    }else {
      echo "Aucun ville trouvée";
    }
  }
  ?>
</span>

<?php // New style for citys show ?>
<div class="suggest_container">
  <?php
		foreach ($cities as $city) {
	?>
    <div class="suggest_block">
      <div class="suggest_row">
        <span class="suggest_col">Ville No <?php echo $city->getId(); ?></span>
      </div>
      <div class="suggest_row">
        <span class="suggest_title"  style="max-width: 100%; overflow: hidden; height: 1.4em;" title="<?php echo ucfirst(htmlspecialchars_decode($city->getName())); ?>"> <?php echo ucfirst(htmlspecialchars_decode($city->getName())); ?></span>
      </div>
      <div class="suggest_row">
        <span class="suggest_col"><i class="material-icons vertical-align-bottom margin-right-5 background-primary">today</i><?php echo get_elapsed_time($city->getAdded_at()); ?></span>

        <div class="suggest_col float-right">
          <?php if($_SESSION["role"] != $session->getRole_3()){ ?>
          <span class="btnEdit" id="btnEdit<?php echo $city->getId(); ?>" title="Modifier cette ville">
            <i class="material-icons vertical-align-bottom">edit</i>
          </span>
          <span class="btnDelete" id="btnDelete<?php echo $city->getId(); ?>" title="Supprimer cette ville">
            <i class="material-icons vertical-align-bottom">close</i>
          </span>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<?php // Modal for add ?>
<div class="item_deleteModal_shadow" id="addModal">
  <div class="item_deleteModal">
    <div class="item_editPwdModal_body">

      <h3 class="margin-top-none">Ajouter une ville</h3>

      <div class="item_modal_input">
          <label for="name">Nom </label>
          <input type="text" name="" value=""  id="name">
      </div>

      <span class="item_modal_indicator" id="add_indicator"></span>

    </div>
    <div class="item_deleteModal_footer">
      <div class="btn btn-primary" id="btnAddConfirm">
        Ajouter
      </div>
      <div class="btn" id="btnAddClose" title="Annuler">
        Annuler
      </div>
    </div>
  </div>
</div>

<?php foreach ($cities as $city) { ?>
  <input type="hidden" name="" value="<?php echo $city->getId(); ?>"  id="id<?php echo $city->getId(); ?>">

  <?php // Modal for Edit ?>
  <div class="item_deleteModal_shadow" id="editModal<?php echo $city->getId(); ?>">
    <div class="item_deleteModal">
      <div class="item_editPwdModal_body">

        <h3 class="margin-top-none">Modifier la ville</h3>

        <p>
          Ville No <?php echo $city->getId(); ?>
          <br>
          Ajouté <?php echo get_elapsed_time($city->getAdded_at()); ?>
        </p>

        <div class="item_modal_input">
            <label for="name<?php echo $city->getId(); ?>">Nom </label>
            <input type="text" name="" value="<?php echo htmlspecialchars_decode($city->getName()); ?>"  id="name<?php echo $city->getId(); ?>">
        </div>

        <span class="item_modal_indicator" id="edit_indicator<?php echo $city->getId(); ?>"></span>

      </div>
      <div class="item_deleteModal_footer">
        <div class="btn btn-primary" id="btnEditConfirm<?php echo $city->getId(); ?>">
          Modifier
        </div>
        <div class="btn" id="btnEditClose<?php echo $city->getId(); ?>" title="Annuler">
          Annuler
        </div>
      </div>
    </div>
  </div>

  <?php // Modal for delete ?>
  <div class="item_deleteModal_shadow" id="deleteModal<?php echo $city->getId(); ?>">
    <div class="item_deleteModal">
      <div class="item_deleteModal_body">
        <i class="material-icons">warning</i>
        <span>Voulez vous vraiment supprimer le ville No <?php echo $city->getId(); ?> ?</span>

      </div>
      <div class="item_deleteModal_footer">
        <div class="btn btn-danger" id="btnDeleteConfirm<?php echo $city->getId(); ?>">
          Supprimer
        </div>
        <div class="btn" id="btnDeleteClose<?php echo $city->getId(); ?>" title="Annuler">
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

        if(name_val != ""){
          $.ajax({
  					url: _ROOT_PATH+path,
  					type: "POST",
  					data:	"id="+id_val
                  +"&name="+name_val,
            beforeSend : function(){
              btn.after('<span class="btn btn-primary btn-loading"><span class="loader"></span></span>');
              btn.hide();
            },
  					success : function(ret){
              alert("effectué avec succès");
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

    <?php foreach ($cities as $city) { ?>
      //for delete
      toggleModal($("#deleteModal<?php echo $city->getId(); ?>"), $("#btnDelete<?php echo $city->getId(); ?>"), $("#btnDeleteClose<?php echo $city->getId(); ?>, #deleteModal<?php echo $city->getId(); ?>"));

      deleteInBD($("#btnDeleteConfirm<?php echo $city->getId(); ?>"), "outils/php/traitement/city/delete-city.php", $("#id<?php echo $city->getId(); ?>"));

      //for edit
      toggleModal($("#editModal<?php echo $city->getId(); ?>"), $("#btnEdit<?php echo $city->getId(); ?>"), $("#btnEditClose<?php echo $city->getId(); ?>, #editModal<?php echo $city->getId(); ?>"));

      putInBD($("#btnEditConfirm<?php echo $city->getId(); ?>"), "outils/php/traitement/city/edit-city.php", $("#id<?php echo $city->getId(); ?>").val(), $("#name<?php echo $city->getId(); ?>"), $("#edit_indicator<?php echo $city->getId(); ?>"));
    <?php } ?>

    //for add
    toggleModal($("#addModal"), $("#btnAdd"), $("#btnAddClose, #addModal"));

    putInBD($("#btnAddConfirm"), "outils/php/traitement/city/add-city.php", "", $("#name"), $("#add_indicator"));
  });
</script>
