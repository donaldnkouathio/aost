$(document).ready(function(){ 
  var have_cv_btn = $('.have_cv_btn');
  var make_cv_btn = $('.make_cv_btn');
  var have_cv_block = $('.have_cv_block');
  var make_cv_block = $('.make_cv_block');

  function toggleCv(btn, btnHide, blockShow, blockHide){
    btn.click(function(){
      btn.addClass("cv_btn_active");
      btnHide.removeClass("cv_btn_active");
      blockShow.show();
      blockHide.hide();
    });
  }

  toggleCv(have_cv_btn, make_cv_btn, have_cv_block, make_cv_block);
  toggleCv(make_cv_btn, have_cv_btn, make_cv_block, have_cv_block);


  var sd_modal = $(".modal_cv");
  var sd_btn_close = $(".modal_btn_cv");
  var job_block = $(".job-block-cv");

  sd_btn_close.click(function() {
    sd_modal.fadeOut();
  });
  job_block.click(function() {
    sd_modal.fadeIn();
  });

  var sd_modal_no_cv = $(".modal_no_cv");
  var sd_btn_close_no_cv = $(".modal_btn_no_cv");
  var job_block_no_cv = $(".job-block-no_cv");

  sd_btn_close_no_cv.click(function() {
    sd_modal_no_cv.fadeOut();
  });
  job_block_no_cv.click(function() {
    sd_modal_no_cv.fadeIn();
  });

});


var job_category_cv = document.getElementById("job-category-cv");
//job_category.text("azertyu");
function fillSubDomain(checkboxItem){
  var separator = ",";

  if(checkboxItem.checked == true){
    job_category_cv.value = job_category_cv.value + checkboxItem.value + separator;
  }else{
    job_category_cv.value = job_category_cv.value.replace(checkboxItem.value + separator, "");
  }
}

var job_category_no_cv = document.getElementById("job-category-no-cv");
//job_category.text("azertyu");
function fillSubDomainNoCv(checkboxItem){
  var separator = ",";

  if(checkboxItem.checked == true){
    job_category_no_cv.value = job_category_no_cv.value + checkboxItem.value + separator;
  }else{
    job_category_no_cv.value = job_category_no_cv.value.replace(checkboxItem.value + separator, "");
  }
}
