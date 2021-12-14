<div class="aside-block">

  <?php
    $rand = random_int(1,2);
    switch ($rand) {
      case 1: ?>

      <div class="">
        <h3 class="color-primary">Vous cherchez de l'emploi ?</h3>
        <p>Nous recevons quotidiennement de nouveaux postes. <br> Consulter notre catalogue d'emplois pour postuler à celui qui vous correspond le mieux</p>
        <a href="<?php echo _ROOT_PATH; ?>job/offers/">Voir les emplois displonible <i class="material-icons vertical-align-bottom"> chevron_right </i></a>
      </div>

  <?php break;
      case 2: ?>
      <div class="">
        <h3 class="color-primary">Vous cherchez de l'emploi ?</h3>
        <p>Nous recevons quotidiennement de nouveaux postes. <br> Vous pouvez nous faire parvenir votre CV et nous vous contacterons</p>
        <a href="<?php echo _ROOT_PATH; ?>job/prompt-application/">Candidature spontanée <i class="material-icons vertical-align-bottom"> chevron_right </i></a>
      </div>
  <?php break;
      case 3:
        echo "hum..";
        break;

      default:
        // code...
        break;
    }
  ?>
</div>
