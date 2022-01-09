<?php
  if(isset($_GET["contact"])){
    include("contact.php");
  }else {
    include("request.php");
  }
?>
