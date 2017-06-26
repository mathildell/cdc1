<form class="form">
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="date">Date:</label>
      <input class="form-control" type="date" name="date" value="<?= date( 'o-m-d', strtotime( $salon['date'] )) ?>">
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="hour">Heure:</label>
      <input class="form-control" type="time" name="hour" value="<?= date( 'H:i', strtotime( $salon['date'] )) ?>">
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="nbr_person_max">Nombre de personnes max.:</label>
      <input class="form-control" type="number" name="nbr_person_max" value="20">
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="type">Type:</label>
      <select name="type" class="form-control">
        <?php foreach($type->getAll() as $key => $type){ ?>
          <option value="<?= $type['id']; ?>"><?= $type['name']; ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="cat">Category:</label>
      <select name="cat" class="form-control">
        <?php foreach($category->getAll() as $key => $cat){ ?>
          <option value="<?= $cat['id']; ?>"><?= $cat['name']; ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="book">Book:</label>
      <select name="book" class="form-control">
        <?php foreach($works->getAll() as $key => $book){ ?>
        <option value="<?= $book['id']; ?>" <?= ($salon['work_id'] == $book['id']) ? 'selected' : ''; ?>><?= $book['name']; ?></option>
        <?php } ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
  </div>
</div>

</form>