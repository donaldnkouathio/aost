$(document).ready(function(){
  function toggleShowMenu(btn, menu, type){
    btn.click(function(){
      switch (type) {
        case "show":
          $("."+menu).css("display","block");
          $("."+menu).css("left","-100%");
          $("."+menu).animate({ "left": "0" });
          break;
        case "hide":
          $("."+menu).css("left","0");
          $("."+menu).animate({ "left": "-100%" });
          //$("."+menu).css("display","none");
          break;
        default:
          alert();
      }
    });
  }

  $(".navMobileBtnClose i").hide();
  var navMobileBtn = $(".navMobileBtnShow");
  var navMobileBtnClose = $(".navMobileBtnClose");


  toggleShowMenu(navMobileBtn, 'nav_block','show');
  toggleShowMenu(navMobileBtnClose, 'nav_block','hide');
})
