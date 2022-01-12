//Init variables
const _ROOT_PATH = "/aost/";
const _refresh_time = 1 * 1000; //Pour les fonctions qui s'exécute périodiquement; defaut 1sec

$(window).load(function() {
  $('.preloader').fadeOut('slow', function() { $(this).remove(); });
});

$(document).ready(function(){

  var footer = $('footer');
  var header = $('header');
  var aside_block = $('.aside-block');
  var current_page_indicator = $('.current_page_indicator');


  //Le but de ce code est de faire floter l'aside sur le côté
  /*if(window.matchMedia('(min-width: 992px)').matches){ //si on sur un desktop
    $(window).scroll(function(){
      var surplus = footer.height() + 50;

      if(($(window).scrollTop() + $(window).height()) + header.height() + surplus - 4050 > $(document).height()){ //bottom
        //alert("bottom"+($(window).height()-header.height()-179));
        //alert(current_page_indicator.height());
        //alert(($(window).height()-header.height()-surplus)+" - "+(aside_block.height()));
        if((aside_block.height()) >= ($(window).height()-header.height() -surplus)){
          //alert("grand");
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

  } */

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


  var count_candidacy = 0;
  var count_prompt_application = 0;
  //Get count notification for candidacy
  setInterval(function(){
    $.ajax({
      url: _ROOT_PATH+"outils/php/traitement/candidacy/get-candidacy-notification.php",
      type: "POST",
      data: "type=candidacy",
      success: function(ret){
        if(ret == 0){
          if(count_prompt_application == 0){
            $(".candidacy-indicator").text("");
            count_candidacy= 0;
          }
        }else {
          $(".candidacy-indicator").text(ret);
          count_candidacy= 1;
        }
      }
    });
  }, _refresh_time);

  //Get count notification for prompt application
  setInterval(function(){
    $.ajax({
      url: _ROOT_PATH+"outils/php/traitement/candidacy/get-candidacy-notification.php",
      type: "POST",
      data: "type=prompt application",
      success: function(ret){
        if(ret == 0){
          $(".candidacy-indicator").text("");
          count_prompt_application= 0;
        }else {
          $(".prompt-application-indicator").text(ret);
          if(count_candidacy == 0){
            $(".candidacy-indicator").text(ret);
            count_prompt_application= 1;
          }
        }
      }
    });
  }, _refresh_time);

  //Get count notification for request
  setInterval(function(){
    $.ajax({
      url: _ROOT_PATH+"outils/php/traitement/request/get-request-notification.php",
      type: "POST",
      data: "type=request",
      success: function(ret){
        if(ret == 0){
          $(".request-indicator").text("");
        }else {
          $(".request-indicator").text(ret);
        }
      }
    });
  }, _refresh_time);
});
