<h2 class="margin-top-none" style="display: inline-block"><?php echo htmlspecialchars_decode($_SESSION['name']); ?></h2>

<?php // Button for add modal ?>
<?php if($_SESSION["role"] == $session->getRole_1()){ ?>
<span class="btnAdd btnAddAdmin" id="btnAdd">
  <i class="notranslate  material-icons vertical-align-bottom margin-right-5">person_add</i>
  <span class="">Ajouter un administrateur</span>
</span>
<?php } ?>

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

  <?php //For Admin online  ?>
  <div class="suggest_block" style="border: 1px solid var(--color-success); border-left: 3px solid var(--color-success);">
    <div class="suggest_row">
      <span class="suggest_col">Admin No <?php echo $_SESSION['id']; ?></span>
    </div>
    <div class="suggest_row">
      <span class="suggest_title"> <?php echo ucfirst(htmlspecialchars_decode($_SESSION['email'])); ?></span>
    </div>
    <div class="suggest_row">
      <span class="suggest_col"><i class="notranslate  material-icons vertical-align-bottom margin-right-5 background-primary">person</i><?php echo ucfirst(htmlspecialchars_decode($_SESSION['name'])); ?></span>
      <span class="suggest_col float-right">Rôle : <?php echo ucfirst(htmlspecialchars_decode($_SESSION['role'])); ?></span>
    </div>
    <div class="suggest_row">
      <span class="suggest_col" title="Compte crée"><i class="notranslate  material-icons vertical-align-bottom margin-right-5 background-primary">today</i><?php echo get_elapsed_time($_SESSION['added_at']); ?></span>
      <div class="suggest_col float-right">
        <?php if($_SESSION["role"] != $session->getRole_3()){ ?>
        <span class="btnEdit" id="btnEditPwd<?php echo $_SESSION["id"]; ?>" title="Changer de mot de passe">
          <i class="notranslate  material-icons vertical-align-bottom">lock</i>
        </span>
        <span class="btnEdit" id="btnEdit<?php echo $_SESSION["id"]; ?>" title="Modifier">
          <i class="notranslate  material-icons vertical-align-bottom">mode_edit</i>
        </span>

        <?php if($_SESSION["role"] == $session->getRole_1()){ ?>
        <span class="btnDelete" id="btnDelete<?php echo $_SESSION["id"]; ?>" title="Supprimer">
          <i class="notranslate  material-icons vertical-align-bottom">close</i>
        </span>
        <?php }} ?>

      </div>
      <div class="suggest_row">
        <span class="suggest_col">Vous ête en ligne</span>
      </div>
    </div>
  </div>

	<?php
		foreach ($admins as $admin) {
      if($admin->getId() != $_SESSION['id']){
	?>
		<div class="suggest_block">
			<div class="suggest_row">
				<span class="suggest_col">Admin No <?php echo $admin->getId(); ?></span>
			</div>
			<div class="suggest_row">
				<span class="suggest_title"> <?php echo ucfirst(htmlspecialchars_decode($admin->getEmail())); ?></span>
			</div>
			<div class="suggest_row">
				<span class="suggest_col"><i class="notranslate  material-icons vertical-align-bottom margin-right-5 background-primary">person</i><?php echo ucfirst(htmlspecialchars_decode($admin->getName())); ?></span>
				<span class="suggest_col float-right">Rôle : <?php echo ucfirst(htmlspecialchars_decode($admin->getRole())); ?></span>
			</div>
			<div class="suggest_row">
				<span class="suggest_col" title="Compte crée"><i class="notranslate  material-icons vertical-align-bottom margin-right-5 background-primary">today</i><?php echo get_elapsed_time($admin->getAdded_at()); ?></span>

        <?php if($_SESSION["role"] == $session->getRole_1()){ ?>
        <div class="suggest_col float-right">
          <?php if($_SESSION["role"] != $session->getRole_3()){ ?>
          <span class="btnEdit" id="btnEditPwd<?php echo $admin->getId(); ?>" title="Changer le mot de passe">
						<i class="notranslate  material-icons vertical-align-bottom">lock</i>
					</span>
					<span class="btnEdit" id="btnEdit<?php echo $admin->getId(); ?>" title="Modifier">
						<i class="notranslate  material-icons vertical-align-bottom">mode_edit</i>
					</span>
					<span class="btnDelete" id="btnDelete<?php echo $admin->getId(); ?>" title="Supprimer">
						<i class="notranslate  material-icons vertical-align-bottom">close</i>
					</span>
          <?php } ?>
				</div>
        <?php } ?>

			</div>
      <div class="suggest_row">
        <span class="suggest_col">Dernière connexion : <?php echo get_elapsed_time($admin->getLast_seen()); ?></span>
      </div>
		</div>
	<?php
    }} ?>
</div>

<?php
  // Modal for edit
  foreach ($admins as $admin) {
?>
<div class="item_modal_shadow" id="editModal<?php echo $admin->getId(); ?>">
  <div class="item_modal">

    <div class="item_modal_body">
      <h2 style="font-weight: normal">Administrateur <strong>No <?php echo $admin->getId(); ?></strong></h2>

      <div class="item_modal_input">
        <label for="email<?php echo $admin->getId(); ?>">Email </label>
        <input type="text" name="" value="<?php echo htmlspecialchars_decode($admin->getEmail()); ?>"  id="email<?php echo $admin->getId(); ?>">
      </div>
      <div class="item_modal_input">
        <label for="name<?php echo $admin->getId(); ?>">Nom & prénom </label>
        <input type="text" name="" value="<?php echo htmlspecialchars_decode($admin->getName()); ?>"  id="name<?php echo $admin->getId(); ?>">
      </div>

      <input type="hidden" name="" value="<?php echo $admin->getPassword(); ?>"  id="password<?php echo $admin->getId(); ?>">

      <?php if($_SESSION["role"] == $session->getRole_1()){ ?>
      <div class="item_modal_input">
        <label for="role<?php echo $admin->getId(); ?>">Rôle</label>
        <select class="" name="" id="role<?php echo $admin->getId(); ?>">
          <option value="<?php echo $session->getRole_1(); ?>" <?php if($admin->getRole() == $session->getRole_1()){echo "selected";} ?>>Super</option>
          <option value="<?php echo $session->getRole_2(); ?>" <?php if($admin->getRole() == $session->getRole_2()){echo "selected";} ?>>Modérateur</option>
        </select>
      </div>
    <?php }else{ ?>
      <input type="hidden" name="" value="<?php echo $admin->getRole(); ?>" id="role<?php echo $admin->getId(); ?>">
    <?php } ?>

      <span class="item_modal_indicator" style="display: block" id="edit_indicator<?php echo $admin->getId(); ?>"></span>

    </div>

    <div class="item_modal_header">
      <div class="btn btn-primary" id="btnEditConfirm<?php echo $admin->getId(); ?>">
        Modifier
      </div>
      <div class="btn" id="btnEditClose<?php echo $admin->getId(); ?>" title="Annuler">
        Annuler
      </div>
    </div>
  </div>
</div>

<input type="hidden" name="" value="<?php echo $admin->getId(); ?>"  id="id<?php echo $admin->getId(); ?>">

<?php // Modal for delete ?>
<div class="item_deleteModal_shadow" id="deleteModal<?php echo $admin->getId(); ?>">
  <div class="item_deleteModal">
    <div class="item_deleteModal_body">
      <i class="notranslate  material-icons">warning</i>
      <span>Voulez vous vraiment supprimer l'administrateur No <?php echo $admin->getId(); ?> ?</span>
      <?php if($_SESSION["id"] == $admin->getId()){ ?>
        <br><span>Il s'agit de votre compte</span>
      <?php } ?>

    </div>
    <div class="item_deleteModal_footer">
      <div class="btn btn-danger" id="btnDeleteConfirm<?php echo $admin->getId(); ?>">
        Supprimer
      </div>
      <div class="btn" id="btnDeleteClose<?php echo $admin->getId(); ?>" title="Annuler">
        Annuler
      </div>
    </div>
  </div>
</div>

<?php // Modal for change password ?>
<div class="item_deleteModal_shadow" id="editPwdModal<?php echo $admin->getId(); ?>">
  <div class="item_deleteModal">
    <div class="item_editPwdModal_body">

      <?php if($_SESSION["id"] == $admin->getId()){ ?>
        <h3 class="margin-top-none">Changer votre mot de passe</h3>
      <?php }else{ ?>
        <h3 class="margin-top-none">Changer le mot de passe de l'admin No <?php echo $admin->getId(); ?></h3>
      <?php } ?>

      <div class="item_modal_input">
          <label for="edit_password<?php echo $admin->getId(); ?>">Nouveau mot de passe </label>
          <input type="password" name="" value=""  id="edit_password<?php echo $admin->getId(); ?>">
      </div>
      <div class="item_modal_input">
          <label for="confirm_edit_password<?php echo $admin->getId(); ?>">Confirmer le mot de passe </label>
          <input type="password" name="" value=""  id="confirm_edit_password<?php echo $admin->getId(); ?>">
      </div>

      <span class="item_modal_indicator" style="display: block" id="pwdIndicator<?php echo $admin->getId(); ?>"></span>

    </div>
    <div class="item_deleteModal_footer">
      <div class="btn btn-primary" id="btnEditPwdConfirm<?php echo $admin->getId(); ?>">
        Changer
      </div>
      <div class="btn" id="btnEditPWDClose<?php echo $admin->getId(); ?>" title="Annuler">
        Annuler
      </div>
    </div>
  </div>
</div>
<?php
  }
?>

<?php // Modal for add ?>
<div class="item_modal_shadow" id="addModal">
  <div class="item_modal">

    <div class="item_modal_body">
      <h2 style="font-weight: normal">Ajouter un administrateur</h2>

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

      <span class="item_modal_indicator" id="add_indicator"></span>
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

    //For add in DB
		function putAdminInBD(btn, path, id, password, email, name, role, indicator){
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
              btn.after('<span class="btn btn-primary btn-loading"><span class="loader"></span></span>');
              btn.hide();
            },
  					success : function(ret){
              $('.btn-loading').hide();
              btn.show();

              if(ret == 1){
                alert("effectué avec succès");
                window.location.reload();
              }else {
                indicator.text("Cet email est déjà utilisée !");
              }
  					}
  				});
        }else {
          indicator.text("Les champs ne doivent pas être vide !");
        }
      });
    }

    //For edit password in DB
		function editPwdInBD(btn, path, id, pwd, confirm_pwd, indicator){
			btn.click(function(){
				var id_val = id.val(),
    				pwd_val = pwd.val(),
				    confirm_pwd_val = confirm_pwd.val();

				if(pwd_val != "" && confirm_pwd_val != ""){

          if(pwd_val == confirm_pwd_val){

            var pwd_tab = pwd_val.split("");

            if(pwd_tab.length >= 6){
              indicator.text("");

              $.ajax({
      					url: _ROOT_PATH+path,
      					type: "POST",
      					data:	"id="+id_val
                      +"&password="+pwd_val,
                beforeSend : function(){
                  btn.after('<span class="btn btn-primary btn-loading"><span class="loader"></span></span>');
                  btn.hide();
                },
      					success : function(ret){
                  alert("Modifié avec succès");
      						window.location.reload();
      					}
      				});
            }else{
              indicator.text("Le mot de passe doit avoir au minimin 6 caractères");
            }

          }else {
            indicator.text("Les mots de passes ne correspondent pas !");
          }
        }else {
          indicator.text("Le mot de passe ne doit pas être vide !");
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

    <?php

      foreach ($admins as $admin) { ?>
				//for delete
        toggleModal($("#deleteModal<?php echo $admin->getId(); ?>"), $("#btnDelete<?php echo $admin->getId(); ?>"), $("#btnDeleteClose<?php echo $admin->getId(); ?>, .item_deleteModal_shadow"));

				deleteAdminInBD($("#btnDeleteConfirm<?php echo $admin->getId(); ?>"), "outils/php/traitement/admin/delete-admin.php", $("#id<?php echo $admin->getId(); ?>"));

        //for edit
				toggleModal($("#editModal<?php echo $admin->getId(); ?>"), $("#btnEdit<?php echo $admin->getId(); ?>"), $("#btnEditClose<?php echo $admin->getId(); ?>, .item_modal_shadow"));

				putAdminInBD($("#btnEditConfirm<?php echo $admin->getId(); ?>"), "outils/php/traitement/admin/edit-admin.php", $("#id<?php echo $admin->getId(); ?>").val(), $("#password<?php echo $admin->getId(); ?>"), $("#email<?php echo $admin->getId(); ?>"), $("#name<?php echo $admin->getId(); ?>"), $("#role<?php echo $admin->getId(); ?>"), $("#edit_indicator<?php echo $admin->getId(); ?>"));

        //for edit password
        toggleModal($("#editPwdModal<?php echo $admin->getId(); ?>"), $("#btnEditPwd<?php echo $admin->getId(); ?>"), $("#btnEditPWDClose<?php echo $admin->getId(); ?>, .item_deleteModal_shadow"));

        editPwdInBD($("#btnEditPwdConfirm<?php echo $admin->getId(); ?>"), "outils/php/traitement/admin/edit-password.php", $("#id<?php echo $admin->getId(); ?>"), $("#edit_password<?php echo $admin->getId(); ?>"), $("#confirm_edit_password<?php echo $admin->getId(); ?>"), $("#pwdIndicator<?php echo $admin->getId(); ?>"));
    <?php

    }
    ?>
    //for add
    toggleModal($("#addModal"), $("#btnAdd"), $("#btnAddClose, .item_modal_shadow"));

    putAdminInBD($("#btnAddConfirm"), "outils/php/traitement/admin/add-admin.php", "0", $("#password"), $("#email"), $("#name"), $("#role"), $("#add_indicator"));

  });
</script>
