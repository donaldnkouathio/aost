<h2 class="margin-top-none">Candidatures <?php if(isset($_GET["prompt"])){ echo "spontanées";} ?></h2>

<div class="show_auther_page_indicateur">
  <i class="material-icons vertical-align-bottom background-primary">info</i>
  <label for="prompt">Afficher les candidatures spontanées
    <?php if(!isset($_GET["prompt"])){ ?>
      <sup style="color: var(--color-danger)" class="prompt-application-indicator"></sup>
    <?php } ?>
  </label>
  <input type="checkbox" name="prompt" id="prompt" value="" <?php if(isset($_GET["prompt"])){echo "checked";} ?>>
</div>

<?php
$candidacies = !isset($_GET["prompt"]) ? $candidacy->getCandidacys() :  $candidacy->getPromptCandidacys();
?>

<span class="stat" style="display: block">
  <?php
  if(count($candidacies) > 1){
    echo count($candidacies)." candidatures trouvées";
  }else {
    if(count($candidacies) > 0){
      echo "Une candidature trouvée";
    }else {
      echo "Aucun candidature trouvée";
    }
  }
  ?>
</span>

<span class="stat" style="display: block; color: var(--color-success)">
  <?php
  $type = isset($_GET["prompt"]) ? "prompt application" : "candidacy";
  $notifications = $notification->getNotificationsByType($type);
  if(count($notifications) > 1){
    echo "Vous avez réçu ".count($notifications)." nouvelles candidatures";
  }else {
    if(count($notifications) > 0){
      echo "Vous avez réçu une nouvelle candidature";
    }else {
      echo "";
    }
  }
  ?>
</span>

<?php // New style for asked offers show ?>
<div class="suggest_container">
  <?php
    foreach ($candidacies as $candidacy) {
      if($notification->getNotificationByTarget($type, $candidacy->getId())){
        $border = "border-color: var(--color-success); ";
      }else {
        $border="";
      }
  ?>
    <div class="suggest_block" style="<?php echo $border; ?>">
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
      <?php if(!isset($_GET["prompt"])){ ?>
      <div class="suggest_row">
        <span class="suggest_row">Intéréssé par l'offre No <?php echo $candidacy->getId_offer(); ?></span>
        <a href="<?php echo _ROOT_PATH."job/offers/a/Offres d'emploi/".$candidacy->getId_offer()."/" ?>" target="_blank" class="btnEdit" id="" title="Voir l'offre">
          Voir l'offre
          <i class="material-icons vertical-align-bottom">launch</i>
        </a>
      </div>
      <?php } ?>
      <div class="suggest_row">
        <?php if($candidacy->getCv_file() != ""){ ?>
        <span class="btnEdit" id="btnSeeCV<?php echo $candidacy->getId(); ?>" title="Voir le CV" style="margin-left: 5px">
          <i class="material-icons vertical-align-bottom">insert_drive_file</i>
          CV
        </span>
        <?php } ?>
        <?php
          if(!isset($_GET["prompt"])){
            if($candidacy->getMotivation_file() != ""){
        ?>
        <span class="btnEdit" id="btnSeeMotivation<?php echo $candidacy->getId(); ?>" title="Voir la lettre de motivation">
          <i class="material-icons vertical-align-bottom">insert_drive_file</i>
          Lettre de motivation
        </span>
        <?php }} ?>
      </div>
      <div class="suggest_row">
        <span><i class="material-icons vertical-align-bottom margin-right-5 background-primary">today</i><?php echo get_elapsed_time($candidacy->getAdded_at()); ?></span>

        <span class="btnDelete float-right" id="btnDeleteCandidacy<?php echo $candidacy->getId(); ?>" title="Supprimer cette candidature">
          <i class="material-icons vertical-align-bottom">close</i>
          Supprimer
        </span>
      </div>
    </div>
  <?php }
    $notification->clearNotificationsByType($type);
  ?>
</div>

<?php foreach ($candidacies as $candidacy) { ?>
  <?php // See CV Modal ?>
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

  <?php // See Motivation Modal ?>
  <?php if(!isset($_GET["prompt"])){ ?>
  <div class="item_modal_shadow" id="seeMotivationModal<?php echo $candidacy->getId(); ?>">
    <div class="item_modal">

      <div class="item_modal_body">
      <!--  <h3 style="font-weight: normal">Candidature <strong>No <?php echo $candidacy->getId(); ?></strong>, posté <?php get_elapsed_time($candidacy->getAdded_at()); ?></h3> -->

        <embed src="<?php echo _ROOT_PATH."files/candidacy/".$candidacy->getId()."/".htmlspecialchars_decode($candidacy->getMotivation_file()) ?>" width="100%" height="98%" type="application/pdf" />

      </div>

      <div class="item_modal_header">
        <div class="btn" id="btnSeeMotivationClose<?php echo $candidacy->getId(); ?>" title="Annuler">
          Annuler
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

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
    $("#prompt").change(function(){
      if($("#prompt").prop("checked")){
        window.location.assign(_ROOT_PATH+"dashboard/asked-offers/p/prompt");
      }else {
        window.location.assign(_ROOT_PATH+"dashboard/asked-offers/");
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
		function deleteCandidacyInBD(btn, path, id){
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

    <?php foreach ($candidacies as $candidacy) { ?>
      //for delete
      toggleModal($("#deleteCandidacyModal<?php echo $candidacy->getId(); ?>"), $("#btnDeleteCandidacy<?php echo $candidacy->getId(); ?>"), $("#btnDeleteCandidacyClose<?php echo $candidacy->getId(); ?>, .item_deleteModal_shadow"));

      deleteCandidacyInBD($("#btnDeleteCandidacyConfirm<?php echo $candidacy->getId(); ?>"), "outils/php/traitement/candidacy/delete-candidacy.php", $("#id<?php echo $candidacy->getId(); ?>"));

      //for see
      toggleModal($("#seeCVModal<?php echo $candidacy->getId(); ?>"), $("#btnSeeCV<?php echo $candidacy->getId(); ?>"), $("#btnSeeCVClose<?php echo $candidacy->getId(); ?>, .item_modal_shadow"));
      toggleModal($("#seeMotivationModal<?php echo $candidacy->getId(); ?>"), $("#btnSeeMotivation<?php echo $candidacy->getId(); ?>"), $("#btnSeeMotivationClose<?php echo $candidacy->getId(); ?>"));
    <?php } ?>
  });
</script>
