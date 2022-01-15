  <footer class="" style="">
    <div class="footer-body offset-10-laptop">
      <div class="footer-logo">
        <img src="<?php echo _ROOT_PATH; ?>img/logo.png" alt="Logo AOST">
        <h1>Alpha Omega Solutions Travail Inc</h1>
      </div>

      <div class="footer-container">

        <div class="footer-contain">
          <h3 class="margin-bottom-none">A propos</h3>
          <p class="margin-top-none">
            AOST est une agence de recrutement, de formation et de placement
            du personnel pour les entreprises québécoises et canadiennes enregistrées
            sous le NEQ 1173599367 au Registraire des entreprises du Québec.
          </p>
        </div>

        <div class="footer-contain contact_us">
          <h3 class="margin-bottom-none">Contactez-nous</h3>
          <p class="margin-top-none">
            <span class="material-icons vertical-align-bottom margin-right-5">location_on</span>
            2232 Rue Noel, H4M1R9 Montréal
            <br>
            <span class="material-icons vertical-align-bottom margin-right-5">phone</span>
            <a style="color: white" href='tel:438-289-5095'> 438-289-5095</a>
            <br>
            <span class="material-icons vertical-align-bottom margin-right-5">phone</span>
            <a style="color: white" href='tel:438-938-8292'> 438-938-8292</a>
          </p>
        </div>


        <div class="footer-contain">
          <h3 class="margin-bottom-none">Suivez-nous</h3>
          <p class="margin-top-none"><a href="https://www.facebook.com/ALPHA-OMEGA-Solutions-Travail-AOST-120693572651635/" target="_blank" style="color: white">Facebook</a></p>
        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <span style="">
        <span class="copyright">Tous droits réservés © <?php echo date('Y', strtotime("TODAY")); ?> - AOST</span>
        <span class="authors">Conçu et dévéloppé par
          <u style="cursor: pointer" class="show_about_author_dnk">Donald Nk</u>
           &
           <u style="cursor: pointer" class="show_about_author_dim">D!m!tr! Bl@ck</u>
         </span>
      </span>
    </div>
  </footer>

</body>
</html>


<div class="alert_modal_shadow dnk">
  <div class="alert_modal_block">
    <div class="alert_modal_body" style="padding: 15px;">
      <img height="80" style="border-radius: 100%;" src="<?php echo _ROOT_PATH; ?>img/authors/dnk.jpeg" alt="Donald Nkouathio picture">
      <br>
      <b style="margin-bottom: 15px; display: inline-block">Donald NKOUATHIO</b>
      <br>
      <span class="material-icons vertical-align-bottom margin-right-5 background-primary">phone</span>
      <a href='tel:+237 655 203 951'> +237 655 203 951</a>
      <br>
      <span class="material-icons vertical-align-bottom margin-right-5 background-primary">email</span>
      <a href='mailto:donaldnkouathio@gmail.com'> Donaldnkouathio@gmail.com</a>
    </div>

    <div class="alert_modal_footer">
      <button type="button" class="btn alert_modal_close" name="button">Fermer</button>
    </div>
  </div>
</div>


<div class="alert_modal_shadow dim">
  <div class="alert_modal_block">
    <div class="alert_modal_body" style="padding: 15px;">
      <img height="80" style="border-radius: 100%;" src="<?php echo _ROOT_PATH; ?>img/authors/dim.jpeg" alt="Dimitry Beyene picture">
      <br>
      <b style="margin-bottom: 15px; display: inline-block">Dimitry BEYENE</b>
      <br>
      <span class="material-icons vertical-align-bottom margin-right-5 background-primary">phone</span>
      <a href='tel:+237 692 503 797'> +237 692 503 797</a>
      <br>
      <span class="material-icons vertical-align-bottom margin-right-5 background-primary">email</span>
      <a href='mailto:dimcompte@gmail.com'> Dimcompte@gmail.com</a>
    </div>

    <div class="alert_modal_footer">
      <button type="button" class="btn alert_modal_close" name="button">Fermer</button>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo _ROOT_PATH; ?>outils/js/global.js"></script>
<script>
  $(document).ready(function(){
    //Show or hide modal
   function toggleModal(modal, modal_btn, modal_btn_close){
     $(".alert_modal_block").click(function(ev){
       ev.stopPropagation();
     });
     modal_btn.click(function(){
       modal.fadeIn();
     });
     modal_btn_close.click(function(){
       modal.fadeOut();
     });
    }

    toggleModal($(".dnk"), $(".show_about_author_dnk"), $(".alert_modal_close, .alert_modal_shadow"));
   toggleModal($(".dim"), $(".show_about_author_dim"), $(".alert_modal_close, .alert_modal_shadow"));
 });
</script>
