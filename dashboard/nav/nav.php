<header>
  <div class="header_left">
    <a href="<?php echo _DASHBOARD_PATH; ?>">
      <img src="<?php echo _ROOT_PATH; ?>img/logo.png" alt="logo AOST">
    </a>
    <span>Tableau de bord</span>
  </div>

  <div class="header_right">
    <span class="hide-on-laptop navMobileBtn navMobileBtnShow"><i class="material-icons vertical-align-bottom">menu</i></span>
    <span class="hide-on-mobile">V 0.1</span>
  </div>
</header>

<nav class="nav_block">
  <ul>
    <li class=""><a class="dashboard_nav_menu hide-on-laptop">Menu <i class="material-icons vertical-align-bottom float-right navMobileBtnClose">close</i></a></li>

    <li style="display:none"><a href="<?php echo _DASHBOARD_PATH; ?>home/" class="dashboard_nav_link <?php if($session->getCurrentPage()=="home"){echo "dashboard_nav_link_hover";} ?>"><i class="material-icons vertical-align-bottom">home</i> Accueil</a></li>

    <li><a href="<?php echo _DASHBOARD_PATH; ?>admins/" class="dashboard_nav_link <?php if($session->getCurrentPage()=="admins"){echo "dashboard_nav_link_hover";} ?>" class="dashboard_nav_link">
      <i class="material-icons vertical-align-bottom">people_outline</i>
       Admins
       <?php if(isset($_SESSION["id"])){ ?>
       <span title="Vous ête en ligne - <?php echo htmlspecialchars_decode(ucfirst($_SESSION["name"])); ?>" class="online-user-indicator"></span>
       <?php } ?>
     </a></li>

    <li><a href="<?php echo _DASHBOARD_PATH; ?>offers/" class="dashboard_nav_link <?php if($session->getCurrentPage()=="offers"){echo "dashboard_nav_link_hover";} ?>"><i class="material-icons vertical-align-bottom">business_center</i> Offres d'emploi</a></li>
    <li><a href="<?php echo _DASHBOARD_PATH; ?>asked-offers/" class="dashboard_nav_link <?php if($session->getCurrentPage()=="asked-offers"){echo "dashboard_nav_link_hover";} ?>"><i class="material-icons vertical-align-bottom">work</i> Candidatures</a></li>
    <li><a href="<?php echo _DASHBOARD_PATH; ?>contact/" class="dashboard_nav_link <?php if($session->getCurrentPage()=="contact"){echo "dashboard_nav_link_hover";} ?>"><i class="material-icons vertical-align-bottom">phone</i> Contacts</a></li>
    <li><a href="<?php echo _DASHBOARD_PATH; ?>domains/" class="dashboard_nav_link <?php if($session->getCurrentPage()=="domains"){echo "dashboard_nav_link_hover";} ?>"><i class="material-icons vertical-align-bottom">domain</i> Domaines</a></li>
    <li><a href="<?php echo _DASHBOARD_PATH; ?>subdomains/" class="dashboard_nav_link <?php if($session->getCurrentPage()=="subdomains"){echo "dashboard_nav_link_hover";} ?>"><i class="material-icons vertical-align-bottom">folder_open</i> Sous-domaines</a></li>
    <li><a href="<?php echo _DASHBOARD_PATH; ?>city/" class="dashboard_nav_link <?php if($session->getCurrentPage()=="city"){echo "dashboard_nav_link_hover";} ?>"><i class="material-icons vertical-align-bottom">location_city</i> Villes</a></li>
    <li><a href="<?php echo _DASHBOARD_PATH; ?>history/" class="dashboard_nav_link <?php if($session->getCurrentPage()=="history"){echo "dashboard_nav_link_hover";} ?>"><i class="material-icons vertical-align-bottom">history</i> Historique</a></li>

    <?php if(isset($_SESSION["email"])){ ?>
      <li><a class="dashboard_nav_link background-danger" id="btnLogOut"><i class="material-icons vertical-align-bottom">logout</i> Se déconecter</a></li>
    <?php } ?>

  </ul>
</nav>

<?php // Modal for logOut ?>
<div class="item_deleteModal_shadow" id="logOutModal">
  <div class="item_deleteModal">
    <div class="item_deleteModal_body">
      <i class="material-icons">warning</i>
      <span>Voulez vous vraiment vous déconnecter ?</span>

    </div>
    <div class="item_deleteModal_footer">
      <div class="btn btn-danger" id="btnLogOutConfirm">
        Se déconnecter
      </div>
      <div class="btn" id="btnLogOutClose" title="Annuler">
        Annuler
      </div>
    </div>
  </div>
</div>
