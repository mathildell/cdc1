<form class="form" method="post" action="<?= $root ?>/processes/edittype">
  <input id="type_id" type="hidden" name="type_id" value="<?= $theType['id'] ?>">
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="name">Name:</label>
      <input class="form-control" id="name" type="text" name="name" value="<?= $theType['name'] ?>">
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
    </div>
  </div>
</div>
<button type="submit" class="btn btn-primary">Modifier</button>
</form>