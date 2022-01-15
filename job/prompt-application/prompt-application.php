<div class="offset-10-laptop prompt-application-block">

  <div class="left">
    <?php echo $session->presentationPage("Candidature spontanée", "bg5"); ?>

    <div class="left-block">
      <p class="">
        Si aucune offre d’emploi ne vous intéresse, alors soumettez-nous votre CV ou
        créez-le en ligne afin d’être dans notre banque de candidatures.
      </p>
      <p>
        Si votre profil nous intéresse et qu’il correspond à un de nos postes à combler, alors
        nous communiquerons avec vous.
      </p>
      <p>
        Nous recevons quotidiennement de nouveaux postes.
        Prenez toutefois connaissance de notre <a href="<?php echo _ROOT_PATH; ?>job/hiring-process/">processus d’embauche</a>.
      </p>
    </div>
  </div>

  <div class="right">
    <?php
    $Posting = new Posting("outils/php/traitement/candidacy/add-candidacy.php", "<h1>Soumettre sa candidature spontanée</h1>", "Envoyer mon CV", "");
    echo $Posting->getPostingSection();
    ?>

  </div>

</div>
