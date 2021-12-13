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
});
