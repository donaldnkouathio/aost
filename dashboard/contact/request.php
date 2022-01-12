<h2 class="margin-top-none">Requêtes d'entreprises</h2>

<div class="show_auther_page_indicateur">
  <i class="material-icons vertical-align-bottom background-primary">info</i>
  <label for="contact">Afficher les contacts d'AOST </label>
  <input type="checkbox" name="contact" id="contact" value="" <?php if(isset($_GET["contact"])){echo "checked";} ?>>
</div>

<?php
$requests = $request->getRequests();
?>

<span class="stat" style="display: block">
  <?php
  if(count($requests) > 1){
    echo count($requests)." requêtes trouvées";
  }else {
    if(count($requests) > 0){
      echo "Une requête trouvée";
    }else {
      echo "Aucun requête trouvée";
    }
  }
  ?>
</span>

<?php // New style for asked offers show ?>
<div class="suggest_container">
  <?php foreach ($requests as $request) { ?>
    <div class="suggest_block">
      <div class="suggest_row">
        <span class="suggest_col">Requête No <?php echo $request->getId(); ?></span>
      </div>
      <div class="suggest_row">
        <span class="suggest_title"><i class="material-icons vertical-align-bottom background-primary">business</i> <?php echo htmlspecialchars_decode($request->getCompagny()); ?></span>
      </div>
      <div class="suggest_row">
        <span class="suggest_col"><i class="material-icons vertical-align-bottom background-primary">location_on</i> <?php echo htmlspecialchars_decode($request->getCity()); ?></span>

        <span class="btnEdit float-right" id="btnSeeMore<?php echo $request->getId(); ?>" title="Voir plus">
         <i class="material-icons vertical-align-bottom">visibility</i>
         Voir plus
       </span>
      </div>
      <div class="suggest_row">
        <span class="suggest_col"><i class="material-icons vertical-align-bottom margin-right-5 background-primary">today</i><?php echo get_elapsed_time($request->getAdded_at()); ?></span>

        <span class="btnDelete float-right" id="btnDelete<?php echo $request->getId(); ?>" title="Supprimer">
          <i class="material-icons vertical-align-bottom">close</i>
          Supprimer
        </span>
      </div>
    </div>
  <?php } ?>
</div>


<?php // Modal for see more ?>
<?php foreach ($requests as $request) { ?>

  <div class="item_modal_shadow" id="seeMoreModal<?php echo $request->getId(); ?>">
    <div class="item_modal">
      <div class="item_modal_body">
        <h2 class="margin-top-none">Détail sur la requête No <?php echo $request->getId(); ?></h2>

        <div class="item_modal_input">
          <label><strong>Compagnie  </strong></label>
          <div><?php echo htmlspecialchars_decode($request->getCompagny()); ?></div>
        </div>
        <div class="item_modal_input">
          <label><strong>Courriel  </strong></label>
          <div><?php echo htmlspecialchars_decode($request->getEmail()); ?></div>
        </div>
        <div class="item_modal_input">
          <label><strong>Ville  </strong></label>
          <div><?php echo htmlspecialchars_decode($request->getCity()); ?></div>
        </div>
        <div class="item_modal_input">
          <label><strong>Type d'industrie  </strong></label>
          <div><?php echo htmlspecialchars_decode($request->getCompagny_type()); ?></div>
        </div>
        <div class="item_modal_input">
          <label><strong>Personne ressource </strong></label>
          <div><?php echo htmlspecialchars_decode($request->getPerson()); ?></div>
        </div>
        <div class="item_modal_input">
          <label><strong>Téléphone  </strong></label>
          <div><?php echo $request->getPhone(); ?></div>
        </div>
        <div class="item_modal_input">
          <label><strong>Télécopieur  </strong></label>
          <div><?php echo $request->getFax_phone(); ?></div>
        </div>

        <h3 class="margin-bottom-none">Description du besoin</h3>
        <div><?php echo htmlspecialchars_decode($request->getNeed()); ?></div>
      </div>
      <div class="item_modal_header">
        <div class="btn" id="btnSeeMoreClose<?php echo $request->getId(); ?>" title="Annuler">
          Fermer
        </div>
      </div>
    </div>
  </div>

  <?php // Modal for delete ?>
  <div class="item_deleteModal_shadow" id="deleteModal<?php echo $request->getId(); ?>">
    <div class="item_deleteModal">
      <div class="item_deleteModal_body">
        <i class="material-icons">warning</i>
        <span>Voulez vous vraiment supprimer la requête No <?php echo $request->getId(); ?> ?</span>

      </div>
      <div class="item_deleteModal_footer">
        <div class="btn btn-danger" id="btnDeleteConfirm<?php echo $request->getId(); ?>">
          Supprimer
        </div>
        <div class="btn" id="btnDeleteClose<?php echo $request->getId(); ?>" title="Annuler">
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

    //For delete offer in DB
		function deleteInBD(btn, path, id){
			btn.click(function(){
				var id_val = id;

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

    <?php foreach ($requests as $request) { ?>
      //for delete
      toggleModal($("#deleteModal<?php echo $request->getId(); ?>"), $("#btnDelete<?php echo $request->getId(); ?>"), $("#btnDeleteClose<?php echo $request->getId(); ?>, .item_deleteModal_shadow"));

      deleteInBD($("#btnDeleteConfirm<?php echo $request->getId(); ?>"), "outils/php/traitement/request/delete-request.php", "<?php echo $request->getId(); ?>");

      //for see more
      toggleModal($("#seeMoreModal<?php echo $request->getId(); ?>"), $("#btnSeeMore<?php echo $request->getId(); ?>"), $("#btnSeeMoreClose<?php echo $request->getId(); ?>, .item_modal_shadow"));
    <?php } ?>

  });
</script>
