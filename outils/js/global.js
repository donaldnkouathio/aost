//Init variables
const _ROOT_PATH = "/aost/";

$(window).load(function() {
  $('.preloader').fadeOut('slow', function() { $(this).remove(); });
});

$(document).ready(function(){

  var footer = $('footer');
  var header = $('header');
  var aside_block = $('.aside-block');


  //Le but de ce code est de faire floter l'aside sur le côté
  if(window.matchMedia('(min-width: 992px)').matches){ //si on sur un desktop
    $(window).scroll(function(){

      if(($(window).scrollTop() + $(window).height()) + footer.height()-150 > $(document).height()){ //bottom
        //alert("bottom"+($(window).height()-header.height()-179));
        //alert(($(window).height()-header.height())+" - "+(aside_block.height()+268));
        if((aside_block.height()) >= ($(window).height()-header.height()-268)){ //alert("grand");
        aside_block.removeClass("aside-block-fixed");
        aside_block.addClass("aside-block-absolute");
      }else {
          //alert("petit");
        }

      }else if($(window).scrollTop() > 0){ //Midle*
        //alert("midle");
        aside_block.addClass("aside-block-fixed");
        aside_block.removeClass("aside-block-absolute");
      }else{ //Top

      }

    });
  }else {

  }

  goToTop_btn = $(".goToTop_btn");

  goToTop_btn.click(function(){
    $(window).scrollTop(0);
  });

  $(window).scroll(function(){

    if($(window).scrollTop() > 300){ //Midle
      //alert("middle");
      goToTop_btn.removeClass("goToTop_btn_hide");
    }else{ //Top
      //alert("top");
      goToTop_btn.addClass("goToTop_btn_hide");
    }

  });


});