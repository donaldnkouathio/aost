<?php
/* formulaires pour les quanditatures spontanée et pour postuler à un emploi */
class Posting{
  private $title;
  private $id_offer;
  private $btnTitle;
  private $pageTraitement;

  public function __construct($pageTraitement, $title, $btnTitle, $id_offer){
    $this->pageTraitement= $pageTraitement;
    $this->title= $title;
    $this->btnTitle= $btnTitle;
    $this->id_offer= $id_offer;
  }

  public function getPostingSection(){
    global $domain;
    global $subdomain;

    $current_offer=[
      'id'=>0,
      'id_admin'=>0,
      'id_subdomain'=>0,
      'id_city'=>0,
      'compagny'=>0,
      'description'=>"",
      'missions'=>"",
      'skill'=>"",
      'candidate_profile'=>"",
      'cv'=>0,
      'motivation'=>0,
      'deleted'=>0,
      'expired'=>0,
      'deadline'=>"",
      'added_at'=>""
    ];
    $offer = new Offer($current_offer);

    if($this->id_offer != ""){
      $offer = $offer -> getOffer($this->id_offer);
    }else {
      $offer->setCv(1);
      $offer->setMotivation(1);
    }
    ?>
    <link rel="stylesheet" href="<?php echo _ROOT_PATH."outils/css/posting.css" ?>"/>

    <h2 class=" margin-top-none"><?php echo $this->title; ?></h2>
    <div class="cv_header">
      <div class="have_cv_btn cv_btn_active">J'ai un CV</div>
      <div class="make_cv_btn">Je veux créer mon CV</div>
    </div>

    <div class="make_cv_block">
      <form id="make_cv_form" class="">
        <div class="input-block">
          <label for="name">Nom<span class="form-required"> </span> :</label>
          <input type="text" name="name" required value="">
        </div>
        <div class="input-block">
          <label for="first_name">Prénom<span class="form-required"> </span> :</label>
          <input type="text" name="first_name" required value="">
        </div>
        <div class="input-block">
          <label for="phone">Téléphone<span class="form-required"> </span> :</label>
          <input type="number" name="phone" required value="">
        </div>
        <div class="input-block">
          <label for="email">Courriel personnel<span class="form-required"> </span> :</label>
          <input type="email" name="email" required value="">
        </div>
        <div class="input-block job-block-no_cv">
          <label for="job-category-no-cv">Catégorie d'emploi <span class="form-required"> </span> :</label>
          <input type="text" class="job-category" id="job-category-no-cv" name="domain" readonly required>
        </div>
        <div class="input-block">
          <label for="city">Ville<span class="form-required"> </span> :</label>
          <input type="text" name="city" required value="">
        </div>
        <div class="input-block text-area-block">
          <label for="about">Lettre de présentation ou commentaires<span class="form-required"> </span> :</label>
          <textarea name="about" required></textarea>
        </div>

        <div class="checkbox-block">
          <input type="checkbox" id="EULA" name="" value="" required>
          <label for="EULA">J'accepte les informations sur les services offerts de Alpha Omega Solutions Travail Inc. (Vous pouvez à tout moment retirer son consentement).</label>
        </div>

        <div class="checkbox-block">
          <input type="checkbox" id="make_cv_alert" name="alert" value="">
          <label for="make_cv_alert">Je veux être notifié par mail si des emplois correspondants à mon profil sont ajoutés</label>
        </div>

        <div class="button-block">
          <button type="submit" id="btn_submit_make_cv" class="btn btn-primary" name="button"><?php echo $this->btnTitle; ?></button>
        </div>

        <input type="hidden" name="request_type" value="make_cv">
        <input type="hidden" name="id_offer" value="<?php echo $this->id_offer; ?>">
      </form>
    </div>

    <!-- block j'ai un CV -->
    <div class="have_cv_block">
      <form class="" id="have_cv_form" enctype="multipart/form-data">
        <div class="input-block">
          <label for="name">Nom<span class="form-required"> </span> :</label>
          <input type="text" name="name" required value="">
        </div>
        <div class="input-block">
          <label for="first_name">Prénom <span class="form-required"> </span> :</label>
          <input type="text" name="first_name" required value="">
        </div>
        <div class="input-block">
          <label for="phone">Téléphone <span class="form-required"> </span> :</label>
          <input type="number" name="phone" required value="">
        </div>
        <div class="input-block">
          <label for="email">Courriel personnel<span class="form-required"> </span> :</label>
          <input type="email" name="email" required value="">
        </div>
        <div class="input-block job-block-cv">
          <label for="job-category-cv">Catégorie d'emploi<span class="form-required"> </span> :</label>
          <input type="text" class="job-category" id="job-category-cv" name="domain" readonly required>
        </div>
        <div class="input-block">
          <label for="city">Ville <span class="form-required"> </span> :</label>
          <input type="text" name="city" required value="">
        </div>
        <div class="input-block text-area-block">
          <label for="about">Lettre de présentation ou commentaires :</label>
          <textarea name="about" ></textarea>
        </div>

        <div class="input-block text-area-block">
          <label for="cv_file">Joindre mon CV (au format PDF)<span class="form-required"> </span> :</label>
          <input type="file" name="cv_file" required value="">
        </div>

        <?php if($offer->getMotivation() == 1 && $this->id_offer != ""){ ?>
          <div class="input-block text-area-block">
            <label for="motivation_file">Joindre ma lettre de motivation (au format PDF)<span class="form-required"> </span> :</label>
            <input type="file" name="motivation_file" required value="">
          </div>
        <?php } ?>

        <div class="checkbox-block">
          <input type="checkbox" id="EULA2" name="" value="" required>
          <label for="EULA2">J'accepte les informations sur les services offerts de Alpha Omega Solutions Travail Inc. (Vous pouvez à tout moment retirer son consentement).</label>
        </div>

        <div class="checkbox-block">
          <input type="checkbox" id="have_cv_alert" name="alert" value="">
          <label for="have_cv_alert">Je veux être notifié par mail si des emplois correspondants à mon profil sont ajoutés</label>
        </div>

        <div class="button-block">
          <button type="submit" id="btn_submit_have_cv" class="btn btn-primary" name="button"><?php echo $this->btnTitle; ?></button>
        </div>

        <input type="hidden" name="request_type" value="have_cv">
        <input type="hidden" name="id_offer" value="<?php echo $this->id_offer; ?>">
      </form>
    </div>

    <div class="sub_domain_modal_shadow">
      <!-- Modal des sous domains -->
      <div class="sub_domain_modal modal_cv">
        <div class="sub_domain_modal_body">

          <?php
          $domains = $domain->getDomains();
          foreach($domains as $domain){
            $subdomains = $subdomain->getListSubdomains($domain->getId());
            ?>
            <div class="sub_domain_modal_item_group">
              <span class="sub_domain_modal_item_title"><?php echo ucfirst(htmlspecialchars_decode($domain->getName())); ?></span>

              <?php foreach($subdomains as $subdomain){ ?>
                <div class="sub_domain_modal_item">
                  <label for="<?php echo ucfirst(htmlspecialchars_decode($subdomain->getName())).$domain->getId(); ?>"><?php echo ucfirst(htmlspecialchars_decode($subdomain->getName())); ?></label>
                  <input class="sd_item" type="checkbox" id="<?php echo ucfirst(htmlspecialchars_decode($subdomain->getName())).$domain->getId(); ?>" name="<?php echo ucfirst(htmlspecialchars_decode($subdomain->getName())); ?>" value="<?php echo ucfirst(htmlspecialchars_decode($subdomain->getName())); ?>" onchange="fillSubDomain(this)">
                </div>
              <?php } ?>
            </div>
          <?php }?>

        </div>

        <div class="sub_domain_modal_footer">
          <button type="button" class="btn btn-primary sub_domain_modal_btn_close modal_btn_cv" name="button">Fermer</button>
        </div>
      </div>
      <!-- *** -->

      <!-- Modal des sous domains pour l'onglet Créer un CV -->
      <div class="sub_domain_modal modal_no_cv">
        <div class="sub_domain_modal_body">

          <?php
          $domains = $domain->getDomains();
          foreach($domains as $domain){
            $subdomains = $subdomain->getListSubdomains($domain->getId());
            ?>
            <div class="sub_domain_modal_item_group">
              <span class="sub_domain_modal_item_title"><?php echo ucfirst(htmlspecialchars_decode($domain->getName())); ?></span>

              <?php foreach($subdomains as $subdomain){ ?>
                <div class="sub_domain_modal_item">
                  <label for="<?php echo ucfirst(htmlspecialchars_decode($subdomain->getName()))."-".$domain->getId(); ?>"><?php echo ucfirst(htmlspecialchars_decode($subdomain->getName())); ?></label>
                  <input class="sd_item" type="checkbox" id="<?php echo ucfirst(htmlspecialchars_decode($subdomain->getName()))."-".$domain->getId(); ?>" name="<?php echo ucfirst(htmlspecialchars_decode($subdomain->getName())); ?>" value="<?php echo ucfirst(htmlspecialchars_decode($subdomain->getName())); ?>" onchange="fillSubDomainNoCv(this)">
                </div>
              <?php } ?>
            </div>
          <?php }?>

        </div>

        <div class="sub_domain_modal_footer">
          <button type="button" class="btn btn-primary sub_domain_modal_btn_close modal_btn_no_cv" name="button">Fermer</button>
        </div>
      </div>
      <!-- *** -->
    </div>

    <div class="alert_modal_shadow">
      <div class="alert_modal_block">
        <div class="alert_modal_body">
          <i class="material-icons">check_circle</i>
          <span class="indicator"></span>
        </div>

        <div class="alert_modal_footer">
          <button type="button" class="btn alert_modal_close" name="button">Fermer</button>
        </div>
      </div>
    </div>

    <script src="<?php echo _ROOT_PATH."outils/js/posting.js" ?>"></script>

    <script>
      $(document).ready(function(){
        // hide modal
        function hideModal(modal, modal_btn_close){
         $(".alert_modal_block").click(function(ev){
           ev.stopPropagation();
         });
         modal_btn_close.click(function(){
           modal.fadeOut();
         });
       }

       hideModal($(".alert_modal_shadow"), $(".alert_modal_close, .alert_modal_shadow"));

       var btn_submit_make_cv = $('#btn_submit_make_cv');
       var btn_submit_have_cv = $('#btn_submit_have_cv');

        //form to make cv
        $('#make_cv_form').submit(function(ev){
          ev.preventDefault();
          var formData = new FormData($('#make_cv_form')[0]);

          if($("#make_cv_alert").prop("checked")){
            formData.set("alert","1");
          }else{
            formData.set("alert","0");
          }

          $.ajax({
            url: "<?php echo _ROOT_PATH; ?><?php echo $this->pageTraitement; ?>",
            type: "POST",
            data: formData,
            beforeSend: function(){
              btn_submit_make_cv.prop("disabled", true);
              btn_submit_make_cv.html('<span class="btn-loading"><span class="loader"></span></span>');
            },
            success: function(ret){
              btn_submit_make_cv.prop("disabled", false);
              btn_submit_make_cv.html("postuler");
              $(".alert_modal_shadow").fadeIn();
              if(ret == 1){
                $(".indicator").text("Candidature soumise avec success");

                $(".sd_item").prop("checked", false);

                $('#make_cv_form')[0].reset();
              }else {
                $(".indicator").text(ret);
              }
            },
            cache: false,
            contentType: false,
            processData: false
          });
        });

        //For have cv
        $('#have_cv_form').submit(function(ev){
          ev.preventDefault();
          var formData = new FormData($('#have_cv_form')[0]);

          if($("#have_cv_alert").prop("checked")){
            formData.set("alert","1");
          }else{
            formData.set("alert","0");
          }

          $.ajax({
            url: "<?php echo _ROOT_PATH; ?><?php echo $this->pageTraitement; ?>",
            type: "POST",
            data: formData,
            beforeSend: function(){
              btn_submit_have_cv.prop("disabled", true);
              btn_submit_have_cv.html('<span class="btn-loading"><span class="loader"></span></span>');
            },
            success: function(ret){
              btn_submit_have_cv.prop("disabled", false);
              btn_submit_have_cv.html("postuler");
              $(".alert_modal_shadow").fadeIn();
              if(ret == 1){
                $(".indicator").text("Candidature soumise avec success");

                $(".sd_item").prop("checked", false);

                $('#have_cv_form')[0].reset();
              }else {
                $(".indicator").text(ret);
              }
            },
            cache: false,
            contentType: false,
            processData: false
          });
        });

      });
    </script>
  <?php }
}

?>
