<footer class="footer">
  <div class="top">
    <div class="row">
      <div class="col-sm-4 identity">
        <img src="<? $root; ?>/view/assets/img/logo.png">
        <p>
          4 rue du Gros Caillou, 75005 Paris
          <br/>
          +33 923129034
          <br/>
          bonjour@clubcritique.fr
        </p>
      </div>
      <div class="col-sm-4 follow">
        <h4 class="footer_title">Nous suivre</h4>
        <ul>
          <li>
            <a href="#" class="icon-facebook-alt"></a>
          </li>
          <li>
            <a href="#" class="icon-twitter"></a>
          </li>
          <li>
            <a href="#" class="icon-google-plus"></a>
          </li>
        </ul>
      </div>
      <div class="col-sm-4 newsletter">
        <h4 class="footer_title">Soyez avertis des prochains salons <br>&amp; partagez vos livres préférés</h4>
        <form class="form-inline" action="<?= $root; ?>/processes/newuser" method="post">
            <input class="form-control" type="text" name="email" placeholder="email">
            <button type="submit" class="btn btn-primary sm">Envoi</button>
        </form>
      </div>
    </div>
  </div>
  <nav class="bottom">
    <div class="row">
      <ul class="col-sm-8">
        <li>
          <a href="#">Politique de confidentialité</a>
        </li>
        <li>
          <a href="#">Conditions générales d’utilisation</a>
        </li>
      </ul>
      <div class="col-sm-4">
        &copy; ESGI 2017
      </div>
    </div>
  </nav>
</footer> 
</body>
</html>