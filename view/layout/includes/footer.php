<footer class="footer">
  <div class="top">
    <div class="row">
      <div class="col-md-4 col-sm-12 identity">
        <img src="<?= $root; ?>/view/assets/img/logo.png">
        <?php $footer = $pages->getOne(4); ?>
        <?= ($footer['content']) ? html_entity_decode($footer['content']) : ''?>
      </div>
      <div class="col-md-4 col-sm-12 follow">
        <h4 class="footer_title">Nous suivre</h4>
        <?php $footer = $pages->getOne(3); ?>
        <?= ($footer['content']) ? html_entity_decode($footer['content']) : ''?>
      </div>
      <div class="col-md-4 col-sm-12 newsletter">
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
      <ul class="col-md-8 col-sm-12">
        <?php 
          $footer_links = $pages->getPages();
          foreach ($footer_links as $key => $link) {
            echo '<li><a href="'.$root.'/page/'.$link['id'].'">'.$link['name'].'</a></li>';
          }
        ?>
      </ul>
      <div class="col-md-4 col-sm-12">
        &copy; ESGI 2017
      </div>
    </div>
  </nav>
</footer> 
</body>
</html>