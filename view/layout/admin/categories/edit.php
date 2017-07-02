<form class="form" method="post" action="<?= $root ?>/processes/editcat">
<input type="hidden" value="<?= $theCat['id'] ?>" id="cat_id" name="cat_id">
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="name">Name:</label>
      <input class="form-control" id="name" type="text" name="name" value="<?= $theCat['name'] ?>">
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
    </div>
  </div>
</div>
<button type="submit" class="btn btn-primary">Modifier</button>
</form>