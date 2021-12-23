<div class="container-box" style="background-image: url('/aost/img/bg/bg1.jpg');">
  <div class="container-box-shadow">
    <div class="offset-10-laptop container-box-body" style="">
      <div class="container-title"><?php echo ucwords($offer->getProfession()); ?></div>
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
            $domain = $domain->getDomain($offer->getId_domain());
            echo $domain->getName();
          ?>
        </p>
      </div>

      <div class="infos_text_item">
        <span>Ville</span>
        <p><?php echo $offer->getCity(); ?></p>
      </div>

      <div class="infos_text_item">
        <span>Mis en ligne</span>
        <p><?php echo get_elapsed_time($offer->getAdded_at()); ?></p>
      </div>

      <div class="infos_text_item">
        <span>Expire</span>
        <p><?php echo get_elapsed_time($offer->getDeadline()); ?></p>
      </div>
    </div>

    <div class="about_block">
      <h2 class="margin-bottom-none">Description</h2>
      <div class="about_text">
        <?php toHtmlElem($offer->getDescription()); ?>
      </div>
    </div>

    <div class="about_block">
      <h2 class="margin-bottom-none">Votre mission</h2>
      <div class="about_text">
        <?php toHtmlElem($offer->getMissions()); ?>
      </div>
    </div>

  </div>
  <div class="aside">

    <div class="about_block">
      <h2 class="margin-bottom-none">Exigences</h2>
      <div class="about_text">
        <?php toHtmlElem($offer->getSkill()); ?>
      </div>
    </div>

    <div class="about_block">
      <h2 class="margin-bottom-none">Profil réchercher</h2>
      <div class="about_text">
        <?php toHtmlElem($offer->getCandidate_profile()); ?>
      </div>
    </div>

  </div>
</div>

<div class="offset-10-laptop">
  <div class="posting-block">
    <?php
      $Posting = new Posting("job/promp-application/traitement.php", "Postuler à cet offre", "Postuler", $offer->getId());
      echo $Posting->getPostingSection();
    ?>
  </div>
</div>

<?php
  function toHtmlElem($str){
    $txt = str_replace("&lt;","<", $str);
    $txt = str_replace("&gt;",">", $txt);
    echo $txt;
  }
?>
