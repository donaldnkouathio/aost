$(document).ready(function(){
  function toggleShowMenu(btn, menu, type){
    btn.click(function(){
      switch (type) {
        case "show":
          $("#"+menu).css("display","block");
          $("#"+menu).css("left","-100%");
          $("#"+menu).animate({ "left": "0" });
          break;
        case "hide":
          $("#"+menu).css("left","0");
          $("#"+menu).animate({ "left": "-100%" });
          //$("#"+menu).css("display","none");
          break;
        default:
          alert();
      }
    });
  }

  var navMobileBtn = $("#navMobileBtn");
  var navMobileBtnClose = $("#navMobileBtnClose");
  toggleShowMenu(navMobileBtn, 'navMobile','show');
  toggleShowMenu(navMobileBtnClose, 'navMobile','hide');

  var subNavEmploiBtn = $("#subNavEmploiBtn");
  var subNavEmploiBtnClose = $("#subNavEmploiBtnClose");
  toggleShowMenu(subNavEmploiBtn, 'subNavEmploi','show');
  toggleShowMenu(subNavEmploiBtnClose, 'subNavEmploi','hide');

  var subNavDomainesBtn = $("#subNavDomainesBtn");
  var subNavDomainesBtnClose = $("#subNavDomainesBtnClose");
  toggleShowMenu(subNavDomainesBtn, 'subNavDomaines','show');
  toggleShowMenu(subNavDomainesBtnClose, 'subNavDomaines','hide');


});
