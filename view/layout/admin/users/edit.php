<div class="profile">
  <?php 
    $exchanges = $user->getExchanges($theUser['id']);
    $count_exchanges = count($exchanges);
  ?>
    <form class="form" method="post" action="<?= $root ?>/processes/edituser" enctype="multipart/form-data">
      <input type="hidden" name="userid" value="<?= $theUser['id']; ?>">
      <section class="pres">
      <div class="row">
        <div class="col-sm-3 profile-pic">
          <img src="<?= $root.$theUser['picture']; ?>" id="uploadImage">
          <label class="btn btn-default btn-file">
            <span class="icon-picture-streamline"></span>
              Browse <input type="file" name="profile_picture" style="display: none;">
          </label>
        </div>
        <div class="col-sm-7 col-sm-offset-1 profile-info">
          <div class="form-group">
            <label for="isAdmin">Est un admin:</label>
            <select name="isAdmin">
              <option value="0" <?= ($theUser['isAdmin'] == 0) ? 'selected' : '' ?>>Non</option>
              <option value="1" <?= ($theUser['isAdmin'] == 1) ? 'selected' : '' ?>>Oui</option>
            </select>

          </div>
          <?php
          if($editMode){
            echo '<div class="form-group"><label for="username">Nom d\'utilisateur:</label><input class="form-control" name="username" id="username" type="text" value="'.$theUser['username'].'"></div>';
          }
          ?>
          <?php
          if($editMode){
            echo '<div class="form-group"><label for="email">Email:</label><input class="form-control" id="email" type="text" name="nike-email" value="'.$theUser['email'].'"></div>';
            echo '<div class="form-group"><label for="password">Mot de passe:</label><input class="form-control" id="password" type="password" name="password" value="'.$theUser['password'].'"></div>';
            echo '<div class="form-group"><label for="password_confirm">Confirmer le mot de passe:</label><input class="form-control" id="password_confirm" type="password" name="password_confirm" value="'.$theUser['password'].'"></div>';
          }
          ?>
           <div class="description" <?= ($editMode) ? 'style="max-width: 100%;"' : ""; ?>>
            <?php

            if($editMode){
              echo '<div class="form-group"><label for="description">Description:</label><textarea class="form-control" id="description" name="description">'.$theUser['description'].'</textarea></div>';
            }

            ?>
           </div>
            <?php 
              echo '<button type="submit" class="btn btn-primary">Valider les modifications</button>';
            ?>
        </div>
      </div>
    </section>
    </form>
  <?php
  ?>
</div>

<script>
$(function(){
  $('.btn-file input').change(function(e) {
      readURL(this);
  });
});
</script>