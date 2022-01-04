<h2 class="margin-top-none" style="display: inline-block">Administrateurs</h2>

<?php // Button for add modal ?>
<span class="btnAdd" id="btnAdd">
  <i class="material-icons" style="font-size : 1em;">add</i>
  <span class="">Ajouter un administrateur</span>
</span>

<?php
  $admins = $admin->getAdmins();
?>

<span class="stat" style="display: block">
  <?php
    if(count($admins) > 1){
      echo count($admins)." admins trouvés";
    }else {
      if(count($admins) > 0){
        echo "Un admin trouvé";
      }else {
        echo "Aucun admin trouvé";
      }
    }
  ?>
</span>

<?php // New style for admins show ?>
<div class="suggest_container">
	<?php
		$i = 0;
		foreach ($admins as $admin) {
	?>
		<div class="suggest_block">
			<div class="suggest_row">
				<span class="suggest_col">Admin No <?php echo $admin->getId(); ?></span>
			</div>
			<div class="suggest_row">
				<span class="suggest_title"> <?php echo ucfirst(htmlspecialchars_decode($admin->getEmail())); ?></span>
			</div>
			<div class="suggest_row">
				<span class="suggest_col"><i class="material-icons vertical-align-bottom margin-right-5 background-primary">person</i><?php echo ucfirst(htmlspecialchars_decode($admin->getName())); ?></span>
				<span class="suggest_col float-right">Rôle : <?php echo ucfirst(htmlspecialchars_decode($admin->getRole())); ?></span>
			</div>
			<div class="suggest_row">
				<span class="suggest_col"><i class="material-icons vertical-align-bottom margin-right-5 background-primary">today</i><?php echo get_elapsed_time($admin->getAdded_at()); ?></span>
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

<?php
  // Modal for edit
  $i = 0;
  foreach ($admins as $admin) {
?>

<div class="item_modal_shadow" id="editModal<?php echo $i; ?>">
  <div class="item_modal">

    <div class="item_modal_body">
      <h3 style="font-weight: normal">Administrateur <strong>No <?php echo $admin->getId(); ?></strong>, ajouté <?php get_elapsed_time($admin->getAdded_at()); ?></h3>

      <div class="item_modal_input">
          <label for="email<?php echo $i; ?>">Email </label>
          <input type="text" name="" value="<?php echo htmlspecialchars_decode($admin->getEmail()); ?>"  id="email<?php echo $i; ?>">
      </div>
      <div class="item_modal_input">
          <label for="name<?php echo $i; ?>">Nom & prénom </label>
          <input type="text" name="" value="<?php echo htmlspecialchars_decode($admin->getName()); ?>"  id="name<?php echo $i; ?>">
      </div>
      <div class="item_modal_input">
          <label for="password<?php echo $i; ?>">Mot de passe </label>
          <input type="text" name="" value="<?php echo $admin->getPassword(); ?>"  id="password<?php echo $i; ?>">
      </div>
      <div class="item_modal_input">
        <label for="role<?php echo $i; ?>">Rôle</label>
        <select class="" name="" id="role<?php echo $i; ?>">
          <option value="super" <?php if($admin->getRole() == "super"){echo "selected";} ?>>Super</option>
          <option value="moderateur" <?php if($admin->getRole() == "moderateur"){echo "selected";} ?>>Modérateur</option>
        </select>
      </div>
    </div>

    <div class="item_modal_header">
      <div class="item_modal_header_left" id="btnEditConfirm<?php echo $i; ?>">
        Modifier
      </div>
      <div class="item_modal_header_right" id="btnEditClose<?php echo $i; ?>" title="Annuler">
        Annuler
      </div>
    </div>
  </div>
</div>

<input type="hidden" name="" value="<?php echo $admin->getId(); ?>"  id="id<?php echo $i; ?>">

<?php // Modal for delete ?>
<div class="item_deleteModal_shadow" id="deleteModal<?php echo $i; ?>">
  <div class="item_deleteModal">
    <div class="item_deleteModal_body">
      <i class="material-icons">warning</i>
      <span>Voulez vous vraiment supprimer l'administrateur No <?php echo $admin->getId(); ?> ?</span>

    </div>
    <div class="item_deleteModal_footer">
      <div class="item_deleteModal_left" id="btnDeleteConfirm<?php echo $i;?>">
        Supprimer
      </div>
      <div class="item_deleteModal_right" id="btnDeleteClose<?php echo $i;?>" title="Annuler">
        Annuler
      </div>
    </div>
  </div>
</div>

<?php
  $i++; }
?>

<?php // Modal for add ?>
<div class="item_modal_shadow" id="addModal">
  <div class="item_modal">

    <div class="item_modal_body">
      <h3 style="font-weight: normal">Veillez remplir ce formulaire pour ajouter un nouvel administrateur</h3>

      <div class="item_modal_input">
          <label for="email">Email </label>
          <input type="text" name="" value=""  id="email">
      </div>
      <div class="item_modal_input">
          <label for="name">Nom & prénom </label>
          <input type="text" name="" value=""  id="name">
      </div>
      <div class="item_modal_input">
          <label for="password">Mot de passe </label>
          <input type="text" name="" value=""  id="password">
      </div>
      <div class="item_modal_input">
        <label for="role">Rôle</label>
        <select class="" name="" id="role">
          <option value="super">Super</option>
          <option value="moderateur" selected>Modérateur</option>
        </select>
      </div>
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
		//Show or hide modal
	  function toggleModal(modal, modal_btn, modal_btn_close){
	    modal_btn.click(function(){
	      modal.fadeIn();
	    });
	    modal_btn_close.click(function(){
	      modal.fadeOut();
	    });
	  }

    //For delete offer in DB
		function putAdminInBD(btn, path, id, email, name, password, role){
			btn.click(function(){
				var id_val = id,
  				  email_val = email.val(),
  				  name_val = name.val(),
  				  password_val = password.val(),
  				  role_val = role.val();

				if(email_val != "" && name_val != "" && password_val != ""){
          $.ajax({
  					url: _ROOT_PATH+path,
  					type: "POST",
  					data:	"id="+id_val
                  +"&email="+email_val
                  +"&name="+name_val
                  +"&password="+password_val
                  +"&role="+role_val,
  					beforeSend : function(){
  						btn.html("chargement...");
  					},
  					success : function(ret){
  						window.location.reload();
  					}
  				});
        }
			});
		}

    //For delete offer in DB
		function deleteAdminInBD(btn, path, id){
			btn.click(function(){
				var id_val = id.val();

				$.ajax({
					url: _ROOT_PATH+path,
					type: "POST",
					data:	"id="+id_val,
					beforeSend : function(){
						btn.html("chargement...");
					},
					success : function(ret){
						window.location.reload();
					}
				});
			});
		}

    <?php
      $i = 0;
      foreach ($admins as $admin) { ?>
				//for delete
        toggleModal($("#deleteModal<?php echo $i;?>"), $("#btnDelete<?php echo $i;?>"), $("#btnDeleteClose<?php echo $i;?>"));

				deleteAdminInBD($("#btnDeleteConfirm<?php echo $i; ?>"), "outils/php/traitement/admin/delete-admin.php", $("#id<?php echo $i; ?>"));

        //for edit
				toggleModal($("#editModal<?php echo $i;?>"), $("#btnEdit<?php echo $i;?>"), $("#btnEditClose<?php echo $i;?>"));

				putAdminInBD($("#btnEditConfirm<?php echo $i; ?>"), "outils/php/traitement/admin/edit-admin.php", $("#id<?php echo $i;?>").val(), $("#email<?php echo $i;?>"), $("#name<?php echo $i;?>"), $("#password<?php echo $i;?>"), $("#role<?php echo $i;?>"));
	  <?php
    $i++;
    }
    ?>
    //for add
    toggleModal($("#addModal"), $("#btnAdd"), $("#btnAddClose"));

    putAdminInBD($("#btnAddConfirm"), "outils/php/traitement/admin/add-admin.php", "0", $("#email"), $("#name"), $("#password"), $("#role"));

  });
</script>
