<?php
  /**
   *
   */ // Utilitaire qui va contenir nos variables de session
  class Utility
  {
    private $currentPage; // Page courante
    private $currentSubPage; // Sous Page courante

    function __construct($currentPage = "home", $currentSubPage = "")
    {
      $this->currentPage = $currentPage;
      $this->currentSubPage = $currentSubPage;
    }

    public function getCurrentPage(){
      return $this->currentPage;
    }
    public function getCurrentSubPage(){
      return $this->currentSubPage;
    }

    public function setCurrentPage($currentPage){
      $this->currentPage = $currentPage;
    }
    public function setCurrentSubPage($currentSubPage){
      $this->currentSubPage = $currentSubPage;
    }
  }

?>
