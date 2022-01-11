<div class="container-box" style="background-image: url('<?php echo _ROOT_PATH; ?>img/bg/bg1.jpg');">
  <div class="container-box-shadow">
    <div class="offset-10-laptop container-box-body" style="">
      <div class="container-title"><?php echo ucwords($subdomain->getName()); ?></div>
    </div>
  </div>
</div>

<div class="offset-10-laptop section_asside_block">
  <div class="section">

    <div class="infos_block">

      <div class="infos_text_item">
        <span>Domaine</span>
        <p>
          <?php
          $domain = $domain->getDomain($subdomain->getId_domain());
          echo $domain->getName();
          ?>
        </p>
      </div>

      <div class="infos_text_item">
        <span>Ville</span>
        <p>
          <?php
          $city = $city->getCity($offer->getId_city());
          echo $city->getName();
          ?>
        </p>
      </div>

      <div class="infos_text_item">
        <span>Mis en ligne</span>
        <p><?php echo get_elapsed_time($offer->getAdded_at()); ?></p>
      </div>

      <div class="infos_text_item">
        <span>Expire</span>
        <p><?php echo get_expired_time($offer->getDeadline()); ?></p>
      </div>
    </div>

    <div class="about_block">
      <h2 class="margin-bottom-none">Description</h2>
      <div class="about_text">
        <?php echo htmlspecialchars_decode($offer->getDescription()); ?>
      </div>
    </div>

    <div class="about_block">
      <h2 class="margin-bottom-none">Votre mission</h2>
      <div class="about_text">
        <?php echo htmlspecialchars_decode($offer->getMissions()); ?>
      </div>
    </div>

  </div>
  <div class="aside">

    <div class="about_block">
      <h2 class="margin-bottom-none">Exigences</h2>
      <div class="about_text">
        <?php echo htmlspecialchars_decode($offer->getSkill()); ?>
      </div>
    </div>

    <div class="about_block">
      <h2 class="margin-bottom-none">Profil réchercher</h2>
      <div class="about_text">
        <?php echo htmlspecialchars_decode($offer->getCandidate_profile()); ?>
      </div>
    </div>

  </div>
</div>

<div class="offset-10-laptop">
  <div class="posting-block">
    <?php
    $Posting = new Posting("outils/php/traitement/candidacy/add-candidacy.php", "Postuler à cet offre", "Postuler", $offer->getId());
    echo $Posting->getPostingSection();
    ?>
  </div>
</div>
