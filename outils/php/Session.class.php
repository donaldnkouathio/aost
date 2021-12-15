<?php
  /**
   *
   */ // Utilitaire qui va contenir nos variables de session
  class Session
  {
    private $currentPage; // Page courante
    private $currentSubPage; // Sous Page courante
    private $currentDomain; // Domain courante

    function __construct($currentPage = "home", $currentSubPage = "", $currentDomain = "")
    {
      $this->currentPage = $currentPage;
      $this->currentSubPage = $currentSubPage;
      $this->currentDomain = $currentDomain;
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
          <?php echo $title; ?>
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
  }

?>
