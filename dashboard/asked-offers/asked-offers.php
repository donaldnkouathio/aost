<h2 class="margin-top-none" style="display: inline-block">Demandes d'offre</h2>

<?php
$candidacies = $candidacy->getCandidacys();
?>

<span class="stat" style="display: block">
  <?php
  if(count($candidacies) > 1){
    echo count($candidacies)." demandes trouvées";
  }else {
    if(count($candidacies) > 0){
      echo "Une demande trouvée";
    }else {
      echo "Aucun demande trouvée";
    }
  }
  ?>
</span>

<?php // New style for asked offers show ?>
<div class="suggest_container">
  <?php foreach ($candidacies as $candidacy) { ?>
    <div class="suggest_block">
      <div class="suggest_row">
        <span class="suggest_col">Candidature No <?php echo $candidacy->getId(); ?></span>
      </div>
      <div class="suggest_row">
        <span class="suggest_title"><i class="material-icons vertical-align-bottom margin-right-5 background-primary">person</i> <?php echo htmlspecialchars_decode($candidacy->getName())." ".htmlspecialchars_decode($candidacy->getFirst_name()); ?></span>
      </div>
      <div class="suggest_row">
        <span class="suggest_col" style="max-width: 100%; overflow: hidden; height: 1.4em;" title="Domaines : <?php echo str_replace(",", " - ", htmlspecialchars_decode($candidacy->getDomains())); ?>">
          <i class="material-icons vertical-align-bottom margin-right-5 background-primary">domain</i>
          Domaines : <?php echo str_replace(",", " - ", htmlspecialchars_decode($candidacy->getDomains())); ?>
        </span>
      </div>
      <div class="suggest_row">
        <span class="suggest_row">Intéréssé par l'offre No <?php echo $candidacy->getId_offer(); ?></span>
        <a href="<?php echo _ROOT_PATH."job/offers/a/Offres d'emploi/".$candidacy->getId_offer()."/" ?>" target="_blank" class="btnEdit" id="" title="Voir l'offre">
          Voir l'offre
          <i class="material-icons vertical-align-bottom">launch</i>
        </a>
      </div>
      <div class="suggest_row">
        <?php if($candidacy->getCv_file() != ""){ ?>
        <span class="btnEdit" id="btnSeeCV<?php echo $candidacy->getId(); ?>" title="Voir le CV" style="margin-left: 5px">
          <i class="material-icons vertical-align-bottom">insert_drive_file</i>
          Voir le CV
        </span>
        <?php } ?>
        <?php if($candidacy->getMotivation_file() != ""){ ?>
        <span class="btnEdit" id="btnSeeMotivation<?php echo $candidacy->getId(); ?>" title="Voir la lettre de motivation">
          <i class="material-icons vertical-align-bottom">insert_drive_file</i>
          Voir la lettre de motivation
        </span>
        <?php } ?>
        <span class="btnDelete" id="btnDeleteCandidacy<?php echo $candidacy->getId(); ?>" title="Supprimer cette candidature">
          <i class="material-icons vertical-align-bottom">close</i>
          Supprimer
        </span>
      </div>
    </div>
  <?php } ?>
</div>

<?php foreach ($candidacies as $candidacy) { ?>
  <div class="item_modal_shadow" id="seeCVModal<?php echo $candidacy->getId(); ?>">
    <div class="item_modal">

      <div class="item_modal_body">
      <!--  <h3 style="font-weight: normal">Candidature <strong>No <?php echo $candidacy->getId(); ?></strong>, posté <?php get_elapsed_time($candidacy->getAdded_at()); ?></h3> -->

        <embed src="<?php echo _ROOT_PATH."files/candidacy/".$candidacy->getId()."/".htmlspecialchars_decode($candidacy->getCv_file()) ?>" width="100%" height="98%" type="application/pdf" />

      </div>

      <div class="item_modal_header">
        <div class="btn" id="btnSeeCVClose<?php echo $candidacy->getId(); ?>" title="Annuler">
          Annuler
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" name="" value="<?php echo $candidacy->getId(); ?>"  id="id<?php echo $candidacy->getId(); ?>">

  <?php // Modal for delete ?>
  <div class="item_deleteModal_shadow" id="deleteCandidacyModal<?php echo $candidacy->getId(); ?>">
    <div class="item_deleteModal">
      <div class="item_deleteModal_body">
        <i class="material-icons">warning</i>
        <span>Voulez vous vraiment supprimer la candidature No <?php echo $candidacy->getId(); ?> ?</span>

      </div>
      <div class="item_deleteModal_footer">
        <div class="btn btn-danger" id="btnDeleteCandidacyConfirm<?php echo $candidacy->getId(); ?>">
          Supprimer
        </div>
        <div class="btn" id="btnDeleteCandidacyClose<?php echo $candidacy->getId(); ?>" title="Annuler">
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
     modal_btn.click(function(){
       modal.fadeIn();
     });
     modal_btn_close.click(function(){
       modal.fadeOut();
     });
    }

    //For delete offer in DB
		function deleteCandidacyInBD(btn, path, id){
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

    <?php foreach ($candidacies as $candidacy) { ?>
      //for delete
      toggleModal($("#deleteCandidacyModal<?php echo $candidacy->getId(); ?>"), $("#btnDeleteCandidacy<?php echo $candidacy->getId(); ?>"), $("#btnDeleteCandidacyClose<?php echo $candidacy->getId(); ?>"));

      deleteCandidacyInBD($("#btnDeleteCandidacyConfirm<?php echo $candidacy->getId(); ?>"), "outils/php/traitement/candidacy/delete-candidacy.php", $("#id<?php echo $candidacy->getId(); ?>"));

      //for edit
      toggleModal($("#seeCVModal<?php echo $candidacy->getId(); ?>"), $("#btnSeeCV<?php echo $candidacy->getId(); ?>"), $("#btnSeeCVClose<?php echo $candidacy->getId(); ?>"));
    <?php } ?>
  });
</script>
