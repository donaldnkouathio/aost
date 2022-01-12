<div class="">
  <h2 class="margin-top-none" style="display: inline-block">Contacts</h2>

  <?php // Button for add modal ?>
  <span class="btnAdd btnAddAdmin" id="btnAdd">
    <i class="material-icons vertical-align-bottom margin-right-5">add</i>
    <span class="">Ajouter un contact</span>
  </span>
</div>

<div class="show_auther_page_indicateur">
  <i class="material-icons vertical-align-bottom background-primary">info</i>
  <label for="contact">Afficher les contacts d'AOST </label>
  <input type="checkbox" name="contact" id="contact" value="" <?php if(isset($_GET["contact"])){echo "checked";} ?>>
</div>

<?php
$contacts = $contact->getContacts();
?>

<span class="stat" style="display: block">
  <?php
  if(count($contacts) > 1){
    echo count($contacts)." contacts trouvés";
  }else {
    if(count($contacts) > 0){
      echo "Un contact trouvé";
    }else {
      echo "Aucun contact trouvé";
    }
  }
  ?>
</span>


<?php // New style for contacts show ?>
<div class="suggest_container">
  <?php foreach ($contacts as $contact) { ?>
    <div class="suggest_block">
      <div class="suggest_row">
        <span class="suggest_col">Contact No <?php echo $contact->getId(); ?></span>
      </div>
      <div class="suggest_row">
        <span class="suggest_title">
          <i class="material-icons vertical-align-bottom margin-right-5 background-primary">phone</i>
          <?php echo $contact->getPhone(); ?>
        </span>
      </div>
      <div class="suggest_row">
        <span class="suggest_col">
          <i class="material-icons vertical-align-bottom margin-right-5 background-primary">person</i>
          <?php echo ucfirst(htmlspecialchars_decode($contact->getName()))." - ".htmlspecialchars_decode($contact->getRole()); ?>
        </span>
      </div>
      <div class="suggest_row">
        <span class="suggest_col"><i class="material-icons vertical-align-bottom margin-right-5 background-primary">today</i><?php echo get_elapsed_time($contact->getAdded_at()); ?></span>

        <div class="suggest_col float-right">
          <span class="btnEdit" id="btnEdit<?php echo $contact->getId(); ?>" title="Modifier cette ville">
            <i class="material-icons vertical-align-bottom">edit</i>
          </span>
          <span class="btnDelete" id="btnDelete<?php echo $contact->getId(); ?>" title="Supprimer cette ville">
            <i class="material-icons vertical-align-bottom">close</i>
          </span>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<?php // Modal for add ?>
<div class="item_modal_shadow" id="addModal">
  <div class="item_modal">
    <div class="item_modal_body">

      <h2 class="margin-top-none">Ajouter un contact</h2>

      <div class="item_modal_input">
          <label for="phone">Contact </label>
          <input type="text" name="" value=""  id="phone">
      </div>
      <div class="item_modal_input">
          <label for="name">Personne ressource </label>
          <input type="text" name="" value=""  id="name">
      </div>
      <div class="item_modal_input">
          <label for="role">Fonction </label>
          <input type="text" name="" value=""  id="role">
      </div>
      <div class="item_modal_input">
          <label for="email">Courriel </label>
          <input type="email" name="" value=""  id="email">
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


<?php foreach ($contacts as $contact) { ?>
  <input type="hidden" name="" value="<?php echo $contact->getId(); ?>"  id="id<?php echo $contact->getId(); ?>">

  <?php // Modal for Edit ?>
  <div class="item_modal_shadow" id="editModal<?php echo $contact->getId(); ?>">
    <div class="item_modal">
      <div class="item_modal_body">

        <h2 class="margin-top-none">Modifier le contact No <?php echo $contact->getId(); ?></h2>

        <div class="item_modal_input">
            <label for="phone<?php echo $contact->getId(); ?>">Contact </label>
            <input type="text" name="" value="<?php echo htmlspecialchars_decode($contact->getPhone()); ?>"  id="phone<?php echo $contact->getId(); ?>">
        </div>
        <div class="item_modal_input">
            <label for="name<?php echo $contact->getId(); ?>">Personne ressource </label>
            <input type="text" name="" value="<?php echo htmlspecialchars_decode($contact->getName()); ?>"  id="name<?php echo $contact->getId(); ?>">
        </div>
        <div class="item_modal_input">
            <label for="role<?php echo $contact->getId(); ?>">Fonction </label>
            <input type="text" name="" value="<?php echo htmlspecialchars_decode($contact->getRole()); ?>"  id="role<?php echo $contact->getId(); ?>">
        </div>
        <div class="item_modal_input">
            <label for="email<?php echo $contact->getId(); ?>">Courriel </label>
            <input type="email" name="" value="<?php echo $contact->getEmail(); ?>"  id="email<?php echo $contact->getId(); ?>">
        </div>

        <span class="item_modal_indicator" id="edit_indicator<?php echo $contact->getId(); ?>"></span>

      </div>
      <div class="item_modal_header">
        <div class="btn btn-primary" id="btnEditConfirm<?php echo $contact->getId(); ?>">
          Modifier
        </div>
        <div class="btn" id="btnEditClose<?php echo $contact->getId(); ?>" title="Annuler">
          Annuler
        </div>
      </div>
    </div>
  </div>

  <?php // Modal for delete ?>
  <div class="item_deleteModal_shadow" id="deleteModal<?php echo $contact->getId(); ?>">
    <div class="item_deleteModal">
      <div class="item_deleteModal_body">
        <i class="material-icons">warning</i>
        <span>Voulez vous vraiment supprimer le contact No <?php echo $contact->getId(); ?> ?</span>

      </div>
      <div class="item_deleteModal_footer">
        <div class="btn btn-danger" id="btnDeleteConfirm<?php echo $contact->getId(); ?>">
          Supprimer
        </div>
        <div class="btn" id="btnDeleteClose<?php echo $contact->getId(); ?>" title="Annuler">
          Annuler
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<script type="text/javascript">
  $(document).ready(function(){
    $("#contact").change(function(){
      if($("#contact").prop("checked")){
        window.location.assign(_ROOT_PATH+"dashboard/contact/c/contact-AOST");
      }else {
        window.location.assign(_ROOT_PATH+"dashboard/contact/");
      }
    });

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
    function putInBD(btn, path, id, name, phone, email, role, indicator){
      btn.click(function(){
        var id_val = id,
            name_val = name.val(),
            phone_val = phone.val(),
            email_val = email.val(),
            role_val = role.val();

        if(name_val != "" && phone_val != "" && email_val != "" && role_val != ""){
          $.ajax({
            url: _ROOT_PATH+path,
            type: "POST",
            data:	"id="+id_val
                  +"&name="+name_val
                  +"&phone="+phone_val
                  +"&email="+email_val
                  +"&role="+role_val,
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
          indicator.text("Les champs ne doivent pas être vide !")
        }

      });
    }

    //For delete in DB
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

    <?php foreach ($contacts as $contact) { ?>
      //for delete
      toggleModal($("#deleteModal<?php echo $contact->getId(); ?>"), $("#btnDelete<?php echo $contact->getId(); ?>"), $("#btnDeleteClose<?php echo $contact->getId(); ?>, #deleteModal<?php echo $contact->getId(); ?>"));

      deleteInBD($("#btnDeleteConfirm<?php echo $contact->getId(); ?>"), "outils/php/traitement/contact/delete-contact.php", $("#id<?php echo $contact->getId(); ?>"));

      //for edit
      toggleModal($("#editModal<?php echo $contact->getId(); ?>"), $("#btnEdit<?php echo $contact->getId(); ?>"), $("#btnEditClose<?php echo $contact->getId(); ?>, #editModal<?php echo $contact->getId(); ?>"));

      //putInBD($("#btnEditConfirm<?php echo $contact->getId(); ?>"), "outils/php/traitement/contact/edit-contact.php", $("#id<?php echo $contact->getId(); ?>").val(), $("#name<?php echo $contact->getId(); ?>"), $("#edit_indicator<?php echo $contact->getId(); ?>"));
      putInBD($("#btnEditConfirm<?php echo $contact->getId(); ?>"), "outils/php/traitement/contact/edit-contact.php", $("#id<?php echo $contact->getId(); ?>").val(), $("#name<?php echo $contact->getId(); ?>"), $("#phone<?php echo $contact->getId(); ?>"), $("#email<?php echo $contact->getId(); ?>"), $("#role<?php echo $contact->getId(); ?>"), $("#edit_indicator<?php echo $contact->getId(); ?>"));
    <?php } ?>

    //for add
    toggleModal($("#addModal"), $("#btnAdd"), $("#btnAddClose, #addModal"));

    putInBD($("#btnAddConfirm"), "outils/php/traitement/contact/add-contact.php", "", $("#name"), $("#phone"), $("#email"), $("#role"), $("#add_indicator"));
});
</script>
