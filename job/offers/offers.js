$(document).ready(function(){
  function toggleShowFiltres(btn, filtresBlock, type){
    btn.click(function(){
      switch (type) {
        case "show":
          $("."+filtresBlock).css("display","block");
          $("."+filtresBlock).css("left","-100%");
          $("."+filtresBlock).animate({ "left": "0" });
          break;
        case "hide":
          $("."+filtresBlock).css("left","0");
          $("."+filtresBlock).animate({ "left": "-100%" });
          //$("#"+menu).css("display","none");
          break;
        default:
          alert();
      }
    });
  }

  var filtresBtn = $(".filtresBtn");
  var filtresBtnClose = $(".filtresBtnClose");
  toggleShowFiltres(filtresBtn, 'offres-filtres','show');
  toggleShowFiltres(filtresBtnClose, 'offres-filtres','hide');


  var domain = $("#domain");
  var inputSearchInput = $(".inputSearchInput");
  domain.change(function(){
    inputSearchInput.val("");
  });

});
