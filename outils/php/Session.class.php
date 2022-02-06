<?php
  /**
   *
   */ // Utilitaire qui va contenir nos variables de session
  class Session
  {
    private $currentPage; // Page courante
    private $currentSubPage; // Sous Page courante
    private $currentDomain; // Domain courante
    private $role_1; //Superadmin
    private $role_2; //Modérateur
    private $role_3; //Hyper, réservé pour les développeurs

    function __construct($currentPage = "home", $currentSubPage = "", $currentDomain = "", $role_1 = "super", $role_2 = "moderateur", $role_3 = "hyper")
    {
      $this->currentPage = $currentPage;
      $this->currentSubPage = $currentSubPage;
      $this->currentDomain = $currentDomain;
      $this->role_1 = $role_1;
      $this->role_2 = $role_2;
      $this->role_3 = $role_3;
    }

    public function getCurrentPage(){
      return $this->currentPage;
    }
    public function getCurrentSubPage(){
      return $this->currentSubPage;
    }
    public function getCurrentDomain(){
      return $this->currentDomain;
    }
    public function getRole_1(){
      return $this->role_1;
    }
    public function getRole_2(){
      return $this->role_2;
    }
    public function getRole_3(){
      return $this->role_3;
    }

    public function setCurrentPage($currentPage){
      $this->currentPage = $currentPage;
    }
    public function setCurrentSubPage($currentSubPage){
      $this->currentSubPage = $currentSubPage;
    }
    public function setCurrentDomain($currentDomain){
      $this->currentDomain = $currentDomain;
    }

    /* Methodes */
    public function presentationPage($title, $img){ ?>
      <div class="presentaion_page_block" <?php echo "style='background-image: url(\""._ROOT_PATH."img/bg/".$img.".jpg\")'"; ?>>
        <div class="presentaion_page_text">
          <h1><?php echo $title; ?></h1>
        </div>
      </div>
    <?php }

    public function preloader(){ ?>
      <div class="preloader">
        <div class="spinner-block">
          <div class="spinner wave_1"></div>
          <div class="spinner wave_2"></div>
          <div class="spinner wave_3"></div>
          <div class="spinner wave_4">AOST...</div>
        </div>
      </div>
    <?php }

    public function goToTop(){ ?>
      <div class="goToTop_block">
        <div class="goToTop_btn goToTop_btn_hide"><i class="notranslate  material-icons vertical-align-bottom"> keyboard_arrow_up </i></div>
      </div>
    <?php }
  }

?>
