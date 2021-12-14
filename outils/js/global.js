$(document).ready(function(){

  var footer = $('footer');
  var header = $('header');
  var aside_block = $('.aside-block');


  //Le but de ce code est de faire floter l'aside sur le côté
  if(window.matchMedia('(min-width: 992px)').matches){ //si on sur un desktop
    $(window).scroll(function(){

      if(($(window).scrollTop() + $(window).height()) + footer.height()-100 > $(document).height()){ //bottom
        //alert("bottom");
        if((aside_block.height() + 150) > ($(window).height()-header.height())){
          aside_block.removeClass("aside-block-fixed");
          aside_block.addClass("aside-block-absolute");
        }else {

        }

      }else if($(window).scrollTop() > header.height()+15){ //Midle

        aside_block.addClass("aside-block-fixed");
        aside_block.removeClass("aside-block-absolute");
      }else{ //Top

        aside_block.removeClass("aside-block-fixed");
      }

    });
  }else {
    
  }
});
