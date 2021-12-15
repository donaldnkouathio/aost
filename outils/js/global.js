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
        //alert(($(window).height()-header.height())+" - "+(aside_block.height()+228));
        if((aside_block.height()) >= ($(window).height()-header.height()-228)){ //alert("grand");
          aside_block.removeClass("aside-block-fixed");
          aside_block.addClass("aside-block-absolute");
        }else {
          //alert("petit");
        }

      }else if($(window).scrollTop() > 0){ //Midle
        aside_block.addClass("aside-block-fixed");
        aside_block.removeClass("aside-block-absolute");
      }else{ //Top

      }

    });
  }else {

  }
});
