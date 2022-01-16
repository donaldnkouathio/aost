<div class="offset-10-laptop contacteznous-block">

  <div class="left">
    <h2>Coordonées</h2>
    <p><i class="material-icons vertical-align-bottom icon"> location_on </i>2232 Rue Noel, H4M1R9 Montréal </p>
    <iframe class="aost-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2796.556710652994!2d-73.68411138463804!3d45.498870739150696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cc91823f9bcd0f3%3A0x62315c3f751bd3a7!2s2232%20Rue%20No%C3%ABl%2C%20Saint-Laurent%2C%20QC%20H4M%201R9%2C%20Canada!5e0!3m2!1sfr!2s!4v1639257524932!5m2!1sfr!2s" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

    <h2>Contacts</h2>
    <?php
      $contacts = $contact->getContacts();
      foreach ($contacts as $contact) {
    ?>
      <p>
        <span><i class="material-icons vertical-align-bottom icon"> phone </i> <?php echo $contact->getPhone(); ?> -</span>
        <span> <?php echo htmlspecialchars_decode($contact->getName()); ?> -</span>
        <span> <?php echo htmlspecialchars_decode($contact->getRole()); ?> </span>
      </p>
    <?php } ?>
  </div>

  <div class="right">
    <h2>Vous avez une question ?</h2>

    <form class="" id="contact_form">
      <div class="input-block">
        <label for="compagnie">Compagnie <span class="form-required"> </span> :</label>
        <input type="text" name="compagny" required value="">
      </div>
      <div class="input-block">
        <label for="ville">Ville où vous êtes <span class="form-required"> </span> :</label>
        <input type="text" name="city" required value="">
      </div>
      <div class="input-block">
        <label for="industrie">Type d'industrie <span class="form-required"> </span> :</label>
        <input type="text" name="compagny_type" required value="">
      </div>
      <div class="input-block">
        <label for="personneRessource">Personne-ressource <span class="form-required"> </span> :</label>
        <input type="text" name="person" required value="">
      </div>
      <div class="input-block">
        <label for="telephone">Téléphone <span class="form-required"> </span> :</label>
        <input type="number" name="phone" required value="">
      </div>
      <div class="input-block">
        <label for="telecopieur">Télécopieur <span class="form-required"> </span> :</label>
        <input type="number" name="fax_phone" required value="">
      </div>
      <div class="input-block">
        <label for="courriel">Courriel <span class="form-required"> </span> :</label>
        <input type="email" name="email" required value="">
      </div>
      <div class="input-block text-area-block">
        <label for="besoin">Décrivez votre besoin <span class="form-required"> </span> :</label>
        <textarea name="need" required></textarea>
      </div>

      <div class="button-block">
        <button type="submit" id="btn_submit_contact" class="btn btn-primary" name="button">Envoyer</button>
      </div>
    </form>
  </div>

</div>

<div class="alert_modal_shadow alert_modal_shadow_request">
  <div class="alert_modal_block">
    <div class="alert_modal_body">
      <i class="material-icons">check_circle</i>
      <span>Envoyé avec success</span>
    </div>

    <div class="alert_modal_footer">
      <button type="button" class="btn alert_modal_close" name="button">Fermer</button>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    // hide modal
   function hideModal(modal, modal_btn_close){
     $(".alert_modal_block").click(function(ev){
       ev.stopPropagation();
     });
     modal_btn_close.click(function(){
       modal.fadeOut();
     });
    }

    hideModal($(".alert_modal_shadow_request"), $(".alert_modal_close, .alert_modal_shadow"));

    var btn_submit_contact = $('#btn_submit_contact');

    //form for contact us
    $('#contact_form').submit(function(ev){
      ev.preventDefault();
      var formData = new FormData($('#contact_form')[0]);

      $.ajax({
        url: "../outils/php/traitement/request/add-request.php",
        type: "POST",
        data: formData,
        beforeSend: function(){
          btn_submit_contact.prop("disabled", true);
          btn_submit_contact.html('<span class="btn-loading"><span class="loader"></span></span>');
        },
        success: function(ret){
          btn_submit_contact.prop("disabled", false);
          btn_submit_contact.html("Envoyer");
          $(".alert_modal_shadow_request").fadeIn();

          $('#contact_form')[0].reset();
        },
        cache: false,
        contentType: false,
        processData: false
      });
    });

  });
</script>
