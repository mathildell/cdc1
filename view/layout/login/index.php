<div class="row">
  <div class="col-sm-6">
    <h2 class="intermediate_title">Se connecter</h2>
    <form class="form" action="<?= $root; ?>/processes/login" method="post" id="loginForm">
      <div class="form-group">
        <label for="email">Adresse email</label>
        <input type="email" name="email" id="email" class="form-control">
      </div>
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control">
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary pull-right">
      </div>
    </form>
  </div>
  <!-- col-md-offset-2 -->
  <div class="col-sm-6">
    <h2 class="intermediate_title">S'inscrire</h2>
    <form class="form" action="<?= $root; ?>/processes/newuser" method="post" id="registerForm">
      <div class="form-group">
        <label for="email">Adresse email</label>
        <input type="email" name="email" id="email" class="form-control">
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary pull-right">
      </div>
    </form>
  </div>
</div>