$(document).ready(function(){

  function autoSuggest(inputName, suggestBlockName){
    var input = $("#"+inputName+"");
    var suggestBlock = $("#"+suggestBlockName+"");
    var suggestText = ["animaux", "épervier", "Mante réligieuse", "escargot", "animal", "oiseaux", "cochon", "cannard", "vautour", "chien", "rene"];

    input.keyup(function(){
      if(input.val() != ""){
        inputSearchValue = input.val();
        suggestBlock.html("");
        var txt = "";
        var regex;

        for (var i = 0; i < suggestText.length; i++) {
          regex = new RegExp(inputSearchValue);

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
    });
  }

  autoSuggest("inputSearchInput", "autoSuggest-block");

});

function remplir(cible, txt, suggestBlock){
  cible.value = txt.innerText;
  suggestBlock.innerHTML = "";
}
