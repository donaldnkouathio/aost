<div class="offset-10-laptop padding-vertical contacteznous-block">

  <div class="left">
    <h2>Coordonées</h2>
    <p><i class="material-icons vertical-align-bottom icon"> location_on </i>2232 Rue Noel, H4M1R9 Montréal </p>
    <iframe class="aost-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2796.556710652994!2d-73.68411138463804!3d45.498870739150696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cc91823f9bcd0f3%3A0x62315c3f751bd3a7!2s2232%20Rue%20No%C3%ABl%2C%20Saint-Laurent%2C%20QC%20H4M%201R9%2C%20Canada!5e0!3m2!1sfr!2s!4v1639257524932!5m2!1sfr!2s" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

    <h2>Contacts</h2>
    <p><i class="material-icons vertical-align-bottom icon"> phone </i> 438-289-5095</p>
    <p><i class="material-icons vertical-align-bottom icon"> phone </i> 438-938-8292</p>
  </div>

  <div class="right">
    <h2>Vous avez une question ?</h2>

    <form class="" action="/aost/contacteznous/contacteznous/traitement.php" method="post">
      <div class="input-block">
        <label for="compagnie">Compagnie :</label>
        <input type="text" name="compagnie" required value="">
      </div>
      <div class="input-block">
        <label for="ville">Ville où vous êtes :</label>
        <input type="text" name="ville" required value="">
      </div>
      <div class="input-block">
        <label for="industrie">Type d'industrie :</label>
        <input type="text" name="industrie" required value="">
      </div>
      <div class="input-block">
        <label for="personneRessource">Personne-ressource :</label>
        <input type="text" name="personneRessource" required value="">
      </div>
      <div class="input-block">
        <label for="telephone">Téléphone :</label>
        <input type="number" name="telephone" required value="">
      </div>
      <div class="input-block">
        <label for="telecopieur">Télécopieur :</label>
        <input type="number" name="telecopieur" required value="">
      </div>
      <div class="input-block">
        <label for="courriel">Courriel :</label>
        <input type="email" name="courriel" required value="">
      </div>
      <div class="input-block">
        <label for="besoin">Décrivez votre besoin :</label>
        <textarea name="besoin" ></textarea>
      </div>

      <button type="submit" class="btn btn-primary" name="button">Envoyer</button>
    </form>
  </div>

</div>
