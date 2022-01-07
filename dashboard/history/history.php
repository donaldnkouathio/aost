<h2 class="margin-top-none" style="display: inline-block">Historique</h2>

<p class="margin-top-none">
  Mois de

  <select class="item_inline_input" name="" id="month">
    <?php
      $histories_group = $history->getHistorysPerMonth();
      $month = isset($_GET["month"]) ? $_GET["month"] : date("Y-m", strtotime("TODAY"));
      foreach($histories_group as $history_group){
    ?>
    <option value="<?php echo date("Y-m", strtotime($history_group->getAdded_at())); ?>" <?php if($month == date("Y-m", strtotime($history_group->getAdded_at()))){echo "selected";} ?>>
      <?php echo get_french_month(date("m", strtotime($history_group->getAdded_at())))." ".date("Y", strtotime($history_group->getAdded_at())); ?>
    </option>
    <?php } ?>
  </select>
</p>

<?php
  $histories_count = $history->getHistorysByMonth($month);
?>

<span class="stat" style="display: block">
  <?php
  if(count($histories_count) > 1){
    echo count($histories_count)." évènements trouvés";
  }else {
    if(count($histories_count) > 0){
      echo "Un évènement trouvé";
    }else {
      echo "Aucun évènement trouvé";
    }
  }
  ?>
</span>

<?php
/* */
$actuParPage= 10; // actu par page
$nombreDePages=ceil(count($histories_count)/$actuParPage); // nombre total de page
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
$histories = $history->getHistorysByMonthLimit($month, $premiereEntree);
?>


<?php // New style for domains show ?>
<div class="suggest_container">
<?php
  foreach ($histories as $history) {
    $color= "";
    if(preg_match("/add/i", $history->getAction())){
      $color = "var(--color-success)";
    }
    elseif(preg_match("/delete/i", $history->getAction())){
      $color = "var(--color-danger)";
    }
    else{
      $color = "var(--color-primary)";
    }

    $icon="";
    if(preg_match("/admin/i", $history->getAction())){
      $icon = '<i class="material-icons vertical-align-bottom  margin-right-5 background-primary">people_outline</i> Admins';
    }
    elseif(preg_match("/offer/i", $history->getAction())){
      $icon = '<i class="material-icons vertical-align-bottom  margin-right-5 background-primary">business_center</i> Offres d\'emploi';
    }
    elseif(preg_match("/candidacy/i", $history->getAction())){
      $icon = '<i class="material-icons vertical-align-bottom  margin-right-5 background-primary">work</i> Candidatures';
    }
    elseif(preg_match("/domain/i", $history->getAction())){
      $icon = '<i class="material-icons vertical-align-bottom  margin-right-5 background-primary">domain</i> Domaines';
    }
    elseif(preg_match("/subdomain/i", $history->getAction())){
      $icon = '<i class="material-icons vertical-align-bottom  margin-right-5 background-primary">folder_open</i> Sous-domaines';
    }
    elseif(preg_match("/city/i", $history->getAction())){
      $icon = '<i class="material-icons vertical-align-bottom  margin-right-5 background-primary">business_center</i> Villes';
    }
    elseif(preg_match("/contact/i", $history->getAction())){
      $icon = '<i class="material-icons vertical-align-bottom  margin-right-5 background-primary">phone</i> Contacts';
    }
    elseif(preg_match("/history/i", $history->getAction())){
      $icon = '<i class="material-icons vertical-align-bottom  margin-right-5 background-primary">history</i> Historique';
    }
    else{
      $icon = "";
    }

?>

  <div class="suggest_block" style="border-color : <?php echo $color; ?>;">
    <div class="suggest_row">
      <span class="suggest_col">Evènement No <?php echo $history->getId(); ?></span>
    </div>
    <div class="suggest_row">
      <span class="suggest_col"><?php echo $icon; ?></span>
    </div>
    <div class="suggest_row">
      <span class=""  style="max-width: 100%; min-height: 3em; display: inline-block;font-weight:bold" title="<?php echo ucfirst(htmlspecialchars_decode($history->getDescription())); ?>"> <?php echo ucfirst(htmlspecialchars_decode($history->getDescription())); ?></span>
    </div>
    <div class="suggest_row">
      <span class="suggest_col"><i class="material-icons vertical-align-bottom margin-right-5 background-primary">today</i><?php echo get_elapsed_time($history->getAdded_at()); ?></span>

      <?php if($_SESSION["role"] == $session->getRole_1()){ ?>
      <span class="btnDelete" id="btnDelete<?php echo $history->getId(); ?>" title="Supprimer">
        <i class="material-icons vertical-align-bottom">close</i>
        Supprimer
      </span>
      <?php } ?>
    </div>
  </div>

<?php } ?>
</div>

<div class="" style="width:100%; text-align: right">
<?php if($nombreDePages > 1){ ?>
<div class="breadcrumb-block">
  <div class="breadcrumb-contain">
    <?php if($pageActuelle >  1){ ?>
      <a class="breadcrumb-item" href="<?php echo _DASHBOARD_PATH."history/m/".$month; ?>/p/<?php echo $pageActuelle - 1; ?>" title="précédant"><i class="material-icons vertical-align-bottom"> chevron_left </i></a>
    <?php }for($i = 1; $i < $nombreDePages+1; $i++){
      if($i == $pageActuelle){ ?>
      <span class="breadcrumb-item breadcrumb-item-active"><?php echo $i; ?></span>
    <?php  }else{ ?>
      <a class="breadcrumb-item" href="<?php echo _DASHBOARD_PATH."history/m/".$month."/p/".$i; ?>"><?php echo $i; ?></a>
    <?php }}if($pageActuelle <= $nombreDePages - 1){ ?>
      <a class="breadcrumb-item" href="<?php echo _DASHBOARD_PATH."history/m/".$month; ?>/p/<?php echo $pageActuelle + 1; ?>" title="suivant"><i class="material-icons vertical-align-bottom"> chevron_right </i></a>
    <?php } ?>
  </div>
</div>
<?php } ?>
</div>


<?php foreach ($histories as $history) { ?>

  <?php // Modal for delete ?>
  <div class="item_deleteModal_shadow" id="deleteModal<?php echo $history->getId(); ?>">
    <div class="item_deleteModal">
      <div class="item_deleteModal_body">
        <i class="material-icons">warning</i>
        <span>Voulez vous vraiment supprimer l'évènement No <?php echo $history->getId(); ?> ?</span>

      </div>
      <div class="item_deleteModal_footer">
        <div class="btn btn-danger" id="btnDeleteConfirm<?php echo $history->getId(); ?>">
          Supprimer
        </div>
        <div class="btn" id="btnDeleteClose<?php echo $history->getId(); ?>" title="Annuler">
          Annuler
        </div>
      </div>
    </div>
  </div>

<?php } ?>

<script type="text/javascript">
  $(document).ready(function(){
    $("#month").change(function(){
      window.location.assign(_ROOT_PATH+"dashboard/history/m/"+$("#month").val());
    });

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
            window.location.reload();
          }
				});
			});
		}

    <?php foreach ($histories as $history) { ?>
      //for delete
      toggleModal($("#deleteModal<?php echo $history->getId(); ?>"), $("#btnDelete<?php echo $history->getId(); ?>"), $("#btnDeleteClose<?php echo $history->getId(); ?>"));

      deleteInBD($("#btnDeleteConfirm<?php echo $history->getId(); ?>"), "outils/php/traitement/history/delete-history.php", "<?php echo $history->getId(); ?>");

    <?php } ?>

  });
</script>
