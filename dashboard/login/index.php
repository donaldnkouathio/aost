<h2 class="margin-top-none">Connexion</h2>

<div class="log_container">

  <h3 class="log_slogan">Connectez-vous pour accéder au tableau de bord</h3>

  <div class="log_block">
    <div class="log_input">
        <label for="email">Email </label>
        <input type="text" name="email" value=""  id="email" required>
    </div>
    <div class="log_input">
        <label for="password">Mot de passe </label>
        <input type="password" name="password" value=""  id="password" required>
    </div>

    <input type="hidden" name="current_page" id="current_page" value="<?php echo __FILE__; ?>">

    <button type="submit" class="btn btn-primary" name="button" id="log_btn">Se connecter</button>
  </div>

</div>
