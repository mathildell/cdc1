<div class="profile">
  <form class="form" method="post" action="<?= $root ?>/processes/newadminuser" enctype="multipart/form-data">
    <section class="pres">
    <div class="row">
      <div class="col-sm-3 profile-pic">
        <img src="<?= $root; ?>/view/assets/img/no-preview.png" id="uploadImage">
        <label class="btn btn-default btn-file">
            <span class="icon-picture-streamline"></span>
            Browse <input type="file" name="profile_picture" style="display: none;">
        </label>
      </div>
      <div class="col-sm-7 col-sm-offset-1 profile-info">
        <div class="form-group">
          <label for="isAdmin">Est un admin:</label>
          <select name="isAdmin">
            <option value="0">Non</option>
            <option value="1">Oui</option>
          </select>

        </div>
        <div class="form-group">
          <label for="username">
            Nom d'utilisateur:
          </label>
          <input class="form-control" name="username" id="username" type="text">
        </div>
        <div class="form-group">
          <label for="email">
            Email:
          </label>
          <input class="form-control" id="email" type="text" name="nike-email">
        </div>
        <div class="form-group">
          <label for="password">
            Mot de passe:
          </label>
          <input class="form-control" id="password" type="password" name="password">
        </div>
        <div class="form-group">
          <label for="password_confirm">
            Confirmer le mot de passe:
          </label>
          <input class="form-control" id="password_confirm" type="password" name="password_confirm">
        </div>
        <div class="description" style="max-width: 100%;">
          <div class="form-group">
            <label for="description">
              Description:
            </label>
            <textarea class="form-control" id="description" name="description"></textarea>
          </div>
         </div>
         <button type="submit" class="btn btn-primary">Créer un nouvel utilisateur</button>
      </div>
    </div>
  </section>
  </form> 
</div>
<script>
$(function(){
  $('.btn-file input').change(function(e) {
      readURL(this);
  });
});
</script>