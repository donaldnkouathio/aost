<h2 class="margin-top-none" style="display: inline-block">Sous-domaines</h2>

<?php // Button for add modal ?>
<span class="btnAdd btnAddAdmin" id="btnAdd">
  <i class="material-icons vertical-align-bottom margin-right-5">add</i>
  <span class="">Ajouter un sous-domaine</span>
</span>

<p class="margin-top-none">
  Domaine
  <select class="item_inline_input" name="" id="domain">
    <?php
      $domains = $domain->getDomains();
      $id_domain = isset($_GET["domain"]) ? $_GET["domain"] : $domain->getIdFirstDomain();
      foreach($domains as $domain){
    ?>
    <option value="<?php echo $domain->getId(); ?>" <?php if($id_domain == $domain->getId()){echo "selected";} ?>><?php echo htmlspecialchars_decode($domain->getName()); ?></option>
    <?php } ?>
  </select>
</p>

<?php

  $subdomains = $subdomain->getListSubdomains($id_domain);
?>

<span class="stat" style="display: block">
  <?php
  if(count($subdomains) > 1){
    echo count($subdomains)." sous-domaines trouvés";
  }else {
    if(count($subdomains) > 0){
      echo "Un sous-domaine trouvé";
    }else {
      echo "Aucun sous-domaine trouvé";
    }
  }
  ?>
</span>


<?php // New style for domains show ?>
<div class="suggest_container">
  <?php
		foreach ($subdomains as $subdomain) {
	?>
    <div class="suggest_block">
      <div class="suggest_row">
        <span class="suggest_col">Sous-domaine No <?php echo $subdomain->getId(); ?></span>
      </div>
      <div class="suggest_row">
        <span class="suggest_title"  style="max-width: 100%; overflow: hidden; height: 1.4em;" title="<?php echo ucfirst(htmlspecialchars_decode($subdomain->getName())); ?>"> <?php echo ucfirst(htmlspecialchars_decode($subdomain->getName())); ?></span>
      </div>
      <div class="suggest_row">
        <span class="suggest_col"><i class="material-icons vertical-align-bottom margin-right-5 background-primary">today</i><?php echo get_elapsed_time($subdomain->getAdded_at()); ?></span>

        <div class="suggest_col float-right">
          <?php if($_SESSION["role"] != $session->getRole_3()){ ?>
          <span class="btnEdit" id="btnEdit<?php echo $subdomain->getId(); ?>" title="Modifier cet sous-domaine">
            <i class="material-icons vertical-align-bottom">edit</i>
          </span>
          <span class="btnDelete" id="btnDelete<?php echo $subdomain->getId(); ?>" title="Supprimer ce sous-domaine">
            <i class="material-icons vertical-align-bottom">close</i>
          </span>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<?php // Modal for add ?>
<div class="item_modal_shadow" id="addModal">
  <div class="item_modal">
    <div class="item_modal_body">

      <h2 class="margin-top-none">Ajouter un sous-domaine</h2>

      <div class="item_modal_input">
          <label for="id_domain">Choisir son domaine </label>
          <select class="" name="id_domain" id="id_domain">
            <?php
              foreach($domains as $domain){
            ?>
            <option value="<?php echo $domain->getId(); ?>" <?php if($id_domain == $domain->getId()){echo "selected";} ?>><?php echo htmlspecialchars_decode($domain->getName()); ?></option>
            <?php } ?>
          </select>
      </div>
      <div class="item_modal_input">
          <label for="name">Nom </label>
          <input type="text" name="" value=""  id="name">
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

<?php foreach($subdomains as $subdomain){ ?>
<input type="hidden" name="" value="<?php echo $subdomain->getId(); ?>"  id="id<?php echo $subdomain->getId(); ?>">

<?php // Modal for edit ?>
<div class="item_modal_shadow" id="editModal<?php echo $subdomain->getId(); ?>">
  <div class="item_modal">
    <div class="item_modal_body">

      <h2 class="margin-top-none">Modifier le sous-domaine No <?php echo $subdomain->getId(); ?></h2>

      <?php $admin = $admin->getAdmin($subdomain->getId_admin()); ?>
      <p>
        Ajouté par <?php echo $admin->getName()." ".get_elapsed_time($subdomain->getAdded_at()); ?>
      </p>

      <div class="item_modal_input">
          <label for="id_domain<?php echo $subdomain->getId(); ?>">Domaine </label>
          <select class="" name="id_domain<?php echo $subdomain->getId(); ?>" id="id_domain<?php echo $subdomain->getId(); ?>">
            <?php
              foreach($domains as $domain){
            ?>
            <option value="<?php echo $domain->getId(); ?>" <?php if($id_domain == $domain->getId()){echo "selected";} ?>><?php echo htmlspecialchars_decode($domain->getName()); ?></option>
            <?php } ?>
          </select>
      </div>
      <div class="item_modal_input">
          <label for="name<?php echo $subdomain->getId(); ?>">Nom </label>
          <input type="text" name="" value="<?php echo htmlspecialchars_decode($subdomain->getName()); ?>"  id="name<?php echo $subdomain->getId(); ?>">
      </div>

      <span class="item_modal_indicator" id="edit_indicator<?php echo $subdomain->getId(); ?>"></span>

    </div>
    <div class="item_modal_header">
      <div class="btn btn-primary" id="btnEditConfirm<?php echo $subdomain->getId(); ?>">
        Modifier
      </div>
      <div class="btn" id="btnEditClose<?php echo $subdomain->getId(); ?>" title="Annuler">
        Annuler
      </div>
    </div>
  </div>
</div>

<?php // Modal for delete ?>
<div class="item_deleteModal_shadow" id="deleteModal<?php echo $subdomain->getId(); ?>">
  <div class="item_deleteModal">
    <div class="item_deleteModal_body">
      <i class="material-icons">warning</i>
      <span>Voulez vous vraiment supprimer le sous-domaine No <?php echo $subdomain->getId(); ?> ?</span>

    </div>
    <div class="item_deleteModal_footer">
      <div class="btn btn-danger" id="btnDeleteConfirm<?php echo $subdomain->getId(); ?>">
        Supprimer
      </div>
      <div class="btn" id="btnDeleteClose<?php echo $subdomain->getId(); ?>" title="Annuler">
        Annuler
      </div>
    </div>
  </div>
</div>
<?php } ?>

<script type="text/javascript">
  $(document).ready(function(){
    $("#domain").change(function(){
      window.location.assign(_ROOT_PATH+"dashboard/subdomains/d/"+$("#domain").val());
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

    //For add domain in DB
    function putInBD(btn, path, id, name, id_domain, indicator){
      btn.click(function(){
        var id_val = id,
            id_domain_val = id_domain.val(),
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
                  +"&id_domain="+id_domain_val
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
          indicator.text("Le nom ne doit pas être vide !");
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

    <?php foreach ($subdomains as $subdomain) { ?>
      //for delete
      toggleModal($("#deleteModal<?php echo $subdomain->getId(); ?>"), $("#btnDelete<?php echo $subdomain->getId(); ?>"), $("#btnDeleteClose<?php echo $subdomain->getId(); ?>, .item_deleteModal_shadow"));

      deleteInBD($("#btnDeleteConfirm<?php echo $subdomain->getId(); ?>"), "outils/php/traitement/subdomain/delete-subdomain.php", $("#id<?php echo $subdomain->getId(); ?>"));

      //for edit
      toggleModal($("#editModal<?php echo $subdomain->getId(); ?>"), $("#btnEdit<?php echo $subdomain->getId(); ?>"), $("#btnEditClose<?php echo $subdomain->getId(); ?>, .item_modal_shadow"));

      putInBD($("#btnEditConfirm<?php echo $subdomain->getId(); ?>"), "outils/php/traitement/subdomain/edit-subdomain.php", $("#id<?php echo $subdomain->getId(); ?>").val(), $("#name<?php echo $subdomain->getId(); ?>"), $("#id_domain<?php echo $subdomain->getId(); ?>"), $("#edit_indicator<?php echo $subdomain->getId(); ?>"));
    <?php } ?>

    //for add
    toggleModal($("#addModal"), $("#btnAdd"), $("#btnAddClose, .item_modal_shadow"));

    putInBD($("#btnAddConfirm"), "outils/php/traitement/subdomain/add-subdomain.php", "", $("#name"), $("#id_domain"), $("#add_indicator"));
  });
</script>
