<section class="pres">
  <form class="form" method="post" action="<?= $root ?>/processes/edituser" enctype="multipart/form-data">
    <input type="hidden" name="userid" value="<?= $curr_user['id']; ?>">
      <div class="row">
        <div class="col-sm-3 profile-pic">
          <img src="<?= $root.$theUser['picture']; ?>" id="uploadImage" >
          <label class="btn btn-default btn-file">
            <span class="icon-picture-streamline"></span>
            Browse <input type="file" name="profile_picture" style="display: none;"> 
          </label>
        </div>
        <div class="col-sm-8 col-sm-offset-1 profile-info">
          <div class="form-group">
            <label for="username">
              Nom d'utilisateur:
            </label>
            <input class="form-control" name="username" id="username" type="text" value="<?= $theUser['username']; ?>"> 
          </div>

          <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control" id="email" type="text" name="nike-email" value="<?= $theUser['email']; ?>"> 
          </div>
          
          <div class="form-group"> 
            <label for="password">Mot de passe:</label>
            <input class="form-control" id="password" type="password" name="password"> 
          </div>

          <div class="form-group"> 
            <label for="password_confirm">Confirmer le mot de passe:</label>
            <input class="form-control" id="password_confirm" type="password" name="password_confirm"> 
          </div>

         <div class="description" style="max-width: 100%;">
          <div class="form-group"> 
            <label for="description">Description:</label>
            <textarea class="form-control" rows="5" id="description" name="description"><?= isset($theUser['description']) ? $theUser['description'] : ''; ?></textarea> 
          </div>
         </div>
          <?php 
          if($theUser['id'] === $curr_user['id']) {
          ?>
          <div class="align-right">
            <button type="submit" class="btn btn-primary">Valider les modifications</button> 
          </div>
          <?php 
          }
          ?>
      </div>
    </div>
  </form>
</section>