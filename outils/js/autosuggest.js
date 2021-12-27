$(document).ready(function(){

  function autoSuggest(inputName, suggestBlockName){
    var input = $("#"+inputName+"");
    var suggestBlock = $("#"+suggestBlockName+"");
    //var suggestText = ["animaux", "épervier", "Mante réligieuse", "escargot", "animal", "oiseaux", "cochon", "cannard", "vautour", "chien", "rene"];

    input.keyup(function(){

      $.ajax({
        url : _ROOT_PATH+'outils/php/traitement/frontend/autosuggest.php',
        type : 'POST',
        dataType : 'TEXT',
        beforeSend : function(){
          suggestBlock.html("chargement...");
        },
        success : function(ret){
          var suggestText = ret.split(",");

          if(input.val() != ""){
            inputSearchValue = input.val();
            suggestBlock.html("");
            var txt = "";
            var regex;

            for (var i = 0; i < suggestText.length - 1; i++) {
              regex = new RegExp(inputSearchValue, "i");

              if(regex.test(suggestText[i]) == true){

                var resultTab = suggestText[i].split(inputSearchValue);
                var resultTxt= resultTab[0];

                for(j=1; j<resultTab.length; j++){
                  resultTxt += "<strong>"+inputSearchValue+"</strong>"+resultTab[j]
                }

                txt += '<li onclick="remplir(document.getElementById(\''+inputName+'\'),this, document.getElementById(\''+suggestBlockName+'\'))" class="autoSuggest-item">'+resultTxt+'</li>';
              }else {
                txt += "";
              }
            }
            suggestBlock.html(txt);
          }else {
            suggestBlock.html("");
          }
        }
      });

    });
  }

  autoSuggest("inputSearchInput", "autoSuggest-block");


/*  var autoSuggestBtn = $("#autosuggest-btn");
  var inputSearchInput = $('#inputSearchInput');
  autoSuggestBtn.click(function(){

    $.ajax({
      url : _ROOT_PATH+'job/offers/offers.php',
      type : 'POST',
      dataType : 'TEXT',
      data : 'keyword='+inputSearchInput.val(),
      beforeSend : function(){
        autoSuggestBtn.html("chargement...");
      },
      success : function(ret){
        autoSuggestBtn.html("Chercher "+inputSearchInput.val());

      }
    });

  });*/
});

function remplir(cible, txt, suggestBlock){
  cible.value = txt.innerText;
  suggestBlock.innerHTML = "";
}
