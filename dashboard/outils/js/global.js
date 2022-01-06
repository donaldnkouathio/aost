$(document).ready(function(){
  $("#log_btn").click(function(){
    var email = $("#email").val(),
        password = $("#password").val(),
        current_page = $("#current_page").val();

    $.ajax({
      url: _ROOT_PATH+"outils/php/traitement/frontend/login.php",
      type: "POST",
      data:	"email="+email
            +"&password="+password
            +"&current_page="+current_page,
      beforeSend : function(){
        $("#log_btn").html("chargement...");
      },
      success : function(ret){
        $("#log_btn").html("Se connecter");

        if(ret == "ok"){
          window.location.reload();
        }else{
          alert("Aucun compte trouvé");
        }
      }
    });
  });

  $("#log_out_btn").click(function(){
    $.ajax({
      url: _ROOT_PATH+"outils/php/traitement/frontend/logout.php",
      type: "POST",
      dataType: "text",
      beforeSend : function(){
        $("#log_out_btn").html("chargement...");
      },
      success : function(ret){
        $("#log_out_btn").html("Se déconnecter");
        window.location.reload();
      }
    });
  });

});
