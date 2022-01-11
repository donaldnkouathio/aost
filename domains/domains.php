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
      <form class="domain-item" action="<?php echo _ROOT_PATH; ?>job/offers/" method="post">
        <input type="hidden" name="keyword" value="<?php echo $subdomain->getName(); ?>">
        <input type="submit" name="" value="<?php echo $subdomain->getName(); ?>">
      </form>
    <?php } ?>
  </div>
</div>
