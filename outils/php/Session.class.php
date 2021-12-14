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
  }

?>
