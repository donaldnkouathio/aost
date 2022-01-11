<div class="container-box" style="background-image: url('<?php echo _ROOT_PATH; ?>img/bg/bg1.jpg');">
  <div class="container-box-shadow">
    <div class="offset-10-laptop container-box-body" style="">
      <div class="container-title"><?php echo ucwords($session->getCurrentDomain()); ?></div>
    </div>
  </div>
</div>

<div class="" style="background-color: var(--color-shadow);">
  <div class="offset-10-laptop about-block domain-item-block">
    <?php
      $subdomains = $subdomain->getListSubdomains($_GET["id"]);
      foreach($subdomains as $subdomain) {
    ?>
      <div class="domain-item">
        <?php echo $subdomain->getName(); ?>
      </div>
    <?php } ?>
  </div>
</div>
