$(document).ready(function(){

  //Show or hide modal
 function toggleModal(modal, modal_btn, modal_btn_close){
   $(".item_deleteModal, .item_modal").click(function(ev){
     ev.stopPropagation();
   });
   modal_btn.click(function(){
     modal.fadeIn();
   });
   modal_btn_close.click(function(){
     modal.fadeOut();
   });
  }

  //for logIn
  $("#log_btn").click(function(){
    var email = $("#email").val(),
    password = $("#password").val(),
    current_page = $("#current_page").val();

    if(email != "" && password != ""){
      $.ajax({
        url: _ROOT_PATH+"outils/php/traitement/frontend/login.php",
        type: "POST",
        data:	"email="+email
        +"&password="+password
        +"&current_page="+current_page,
        beforeSend : function(){
          $("#log_btn").html('<span class="loader"></span>');
        },
        success : function(ret){
          $("#log_btn").html("Se connecter");

          if(ret == "ok"){
            window.location.reload();
          }else{
            $("#indicator").text("Email ou mot de passe incorrecte !");
          }
        }
      });
    }else {
      $("#indicator").text("Les champs ne doivent pas être vide !");
    }
  });

  //for logOut
  toggleModal($("#logOutModal"), $("#btnLogOut"), $("#btnLogOutClose, .item_deleteModal_shadow"));

  $("#btnLogOutConfirm").click(function(){
    $.ajax({
      url: _ROOT_PATH+"outils/php/traitement/frontend/logout.php",
      type: "POST",
      dataType: "text",
      beforeSend : function(){
        $("#btnLogOutConfirm").after('<span class="btn btn-danger btn-loading"><span class="loader"></span></span>');
        $("#btnLogOutConfirm").hide();
      },
      success : function(ret){
        window.location.reload();
      }
    });
  });

});
