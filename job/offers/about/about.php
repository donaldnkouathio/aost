<div class="" style="background-color: var(--color-shadow)">

  <div class="container-box" style="background-image: url('<?php echo _ROOT_PATH; ?>img/bg/bg1.jpg'); ">
    <div class="container-box-shadow">
      <div class="offset-10-laptop container-box-body" style="">
        <div class="container-title">
          <div class="" style="font-weight: normal; font-size: 0.4em;">
            - Offre d'emploi No <?php echo $offer->getId(); ?> -
          </div>
          <h1 class="about-title"><?php echo ucwords(htmlspecialchars_decode($subdomain->getName())); ?></h1>
        </div>
      </div>
    </div>
  </div>

  <div class="offset-10-laptop section_asside_block background-white padding-horizontal" style="">
    <div class="section">

      <div class="infos_block">

        <div class="infos_text_item">
          <span>Domaine</span>
          <p>
            <?php
            $domain = $domain->getDomain($subdomain->getId_domain());
            echo ucwords(strtolower(htmlspecialchars_decode($domain->getName())));
            ?>
          </p>
        </div>

        <div class="infos_text_item">
          <span>Ville</span>
          <p>
            <?php
            $city = $city->getCity($offer->getId_city());
            echo ucwords(strtolower(htmlspecialchars_decode($city->getName())));
            ?>
          </p>
        </div>

        <div class="infos_text_item">
          <span>Mise en ligne</span>
          <p><?php echo get_elapsed_time($offer->getAdded_at()); ?></p>
        </div>

        <div class="infos_text_item">
          <span>Expiration</span>
          <p><?php echo get_expired_time($offer->getDeadline()); ?></p>
        </div>
      </div>

      <div class="about_block">
        <h1 class="margin-bottom-none">Description</h1>
        <div class="about_text">
          <?php echo htmlspecialchars_decode($offer->getDescription()); ?>
        </div>
      </div>

      <div class="about_block">
        <h1 class="margin-bottom-none" style="margin-top: 40px;">Votre mission</h1>
        <div class="about_text">
          <?php echo htmlspecialchars_decode($offer->getMissions()); ?>
        </div>
      </div>

    </div>
    <div class="aside">

      <div class="about_block">
        <h1 class="margin-bottom-none">Exigences</h1>
        <div class="about_text">
          <?php echo htmlspecialchars_decode($offer->getSkill()); ?>
        </div>
      </div>

      <div class="about_block">
        <h1 class="margin-bottom-none" style="margin-top: 40px;">Profil recherché</h1>
        <div class="about_text">
          <?php echo htmlspecialchars_decode($offer->getCandidate_profile()); ?>
        </div>
      </div>

    </div>
  </div>

  <div class="offset-10-laptop background-white padding-horizontal" style="margin-top: 15px; padding-top: 15px">
    <div class="posting-block">
      <?php
      $Posting = new Posting("outils/php/traitement/candidacy/add-candidacy.php", "Postuler à cette offre", "Postuler", $offer->getId());
      echo $Posting->getPostingSection();
      ?>
    </div>
  </div>
</div>

<?php
  $subdomain = $subdomain->getSubdomain($offer->getId_subdomain());
?>
<script type="application/ld+json">
  {
    "@context" : "https://schema.org/",
    "@type" : "JobPosting",
    "title" : "<?php echo ucwords(htmlspecialchars_decode($subdomain->getName())); ?>",
    "description" : "<?php echo htmlspecialchars_decode($offer->getDescription()); ?>",
    "identifier": {
      "@type": "PropertyValue",
      "name": "aost",
      "value": "ao<?php echo $offer->getId(); ?>st"
    },
    "datePosted" : "<?php echo $offer->getAdded_at(); ?>",
    "validThrough" : "<?php echo $offer->getDeadline(); ?>",
    "employmentType" : ["FULL_TIME"],
    "hiringOrganization" : {
      "@type" : "Organization",
      "name" : "Alpha Omega Solutions Travail",
      "sameAs" : "https://alphaomegasolutionstravail.ca",
      "logo" : "https://alphaomegasolutionstravail.ca/img/icon.png"
    },
    "jobLocation": {
    "@type": "Place",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "2232 Rue Noel, H4M1R9 Montreal",
        "addressLocality": "<?php echo ucwords(strtolower(htmlspecialchars_decode($city->getName()))); ?>",
        "addressRegion": "Quebec",
        "postalCode": "00000",
        "addressCountry": "Canada"
      }
    },
    "directApply": true,
    "baseSalary": {
      "@type": "MonetaryAmount",
      "currency": "CAD",
      "value": {
        "@type": "QuantitativeValue",
        "value": 12.50,
        "unitText": "HOUR"
      }
    }
  }
</script>
