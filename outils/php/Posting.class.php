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
      <form class="" action="<?php echo _ROOT_PATH; ?><?php echo $this->pageTraitement; ?>" method="post">
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
          <input type="text" name="phone" required value="">
        </div>
        <div class="input-block">
          <label for="email">Courriel personnel<span class="form-required"> </span> :</label>
          <input type="text" name="email" required value="">
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
          <label for="EULA">J'accepte des informations sur les services offerts de Alpha Omega Solutions Travail Inc. (Vous pouvez, à tout moment, retirer son consentement).</label>
        </div>

        <div class="button-block">
          <button type="submit" class="btn btn-primary" name="button"><?php echo $this->btnTitle; ?></button>
        </div>

        <input type="hidden" name="request_type" value="make_cv">
        <input type="hidden" name="id_offer" value="<?php echo $this->id_offer; ?>">
      </form>
    </div>

    <!-- block j'ai un CV -->
    <div class="have_cv_block">
      <form class="" action="<?php echo _ROOT_PATH; ?><?php echo $this->pageTraitement; ?>" method="post" enctype="multipart/form-data">
        <div class="input-block">
          <label for="name">Nom<span class="form-required"> </span> :</label>
          <input type="text" name="name" required value="">
        </div>
        <div class="input-block">
          <label for="first_name">Prénom :</label>
          <input type="text" name="first_name" value="">
        </div>
        <div class="input-block">
          <label for="phone">Téléphone :</label>
          <input type="text" name="phone" value="">
        </div>
        <div class="input-block">
          <label for="email">Courriel personnel<span class="form-required"> </span> :</label>
          <input type="text" name="email" value="">
        </div>
        <div class="input-block job-block-cv">
          <label for="job-category-cv">Catégorie d'emploi<span class="form-required"> </span> :</label>
          <input type="text" class="job-category" id="job-category-cv" name="domain" readonly required>
        </div>
        <div class="input-block">
          <label for="city">Ville :</label>
          <input type="text" name="city" value="">
        </div>
        <div class="input-block text-area-block">
          <label for="about">Lettre de présentation ou commentaires :</label>
          <textarea name="about" ></textarea>
        </div>

        <?php if($offer->getCv() == 1){ ?>
        <div class="input-block text-area-block">
          <label for="cv_file">Joindre mon CV (au format PDF)<span class="form-required"> </span> :</label>
          <input type="file" name="cv_file" required value="">
        </div>
        <?php } ?>

        <?php if($offer->getMotivation() == 1){ ?>
        <div class="input-block text-area-block">
          <label for="motivation_file">Joindre ma lettre de motivation (au format PDF)<span class="form-required"> </span> :</label>
          <input type="file" name="motivation_file" required value="">
        </div>
        <?php } ?>

        <div class="checkbox-block">
          <input type="checkbox" id="EULA2" name="" value="" required>
          <label for="EULA2">J'accepte des informations sur les services offerts de Alpha Omega Solutions Travail Inc. (Vous pouvez, à tout moment, retirer son consentement).</label>
        </div>

        <div class="button-block">
          <button type="submit" class="btn btn-primary" name="button"><?php echo $this->btnTitle; ?></button>
        </div>

        <input type="hidden" name="request_type" value="have_cv">
        <input type="hidden" name="id_offer" value="<?php echo $this->id_offer; ?>">
      </form>
    </div>

    <!-- Modal des sous domains -->
    <div class="sub_domain_modal modal_cv">
      <div class="sub_domain_modal_body">

        <?php
        $domains = $domain->getDomains();
        foreach($domains as $domain){
          $subdomains = $subdomain->getListSubdomains($domain->getId());
          ?>
          <div class="sub_domain_modal_item_group">
            <span class="sub_domain_modal_item_title"><?php echo $domain->getName(); ?></span>

            <?php foreach($subdomains as $subdomain){ ?>
              <div class="sub_domain_modal_item">
                <label for="<?php echo $subdomain->getName().$domain->getId(); ?>"><?php echo $subdomain->getName(); ?></label>
                <input class="sd_item" type="checkbox" id="<?php echo $subdomain->getName().$domain->getId(); ?>" name="<?php echo $subdomain->getName(); ?>" value="<?php echo $subdomain->getName(); ?>" onchange="fillSubDomain(this)">
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
            <span class="sub_domain_modal_item_title"><?php echo $domain->getName(); ?></span>

            <?php foreach($subdomains as $subdomain){ ?>
              <div class="sub_domain_modal_item">
                <label for="<?php echo $subdomain->getName()."-".$domain->getId(); ?>"><?php echo $subdomain->getName(); ?></label>
                <input class="sd_item" type="checkbox" id="<?php echo $subdomain->getName()."-".$domain->getId(); ?>" name="<?php echo $subdomain->getName(); ?>" value="<?php echo $subdomain->getName(); ?>" onchange="fillSubDomainNoCv(this)">
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

    <script src="<?php echo _ROOT_PATH."outils/js/posting.js" ?>"></script>
  <?php }
}

?>
