<form class="form">
  
<div class="row">

  <div class="col-sm-12 book-card book-xl">
    <a href="<?= $root . '/discover/' . $discover_type['name'] . '/' . $discover_cat['name'] . '/' . $book['id']; ?>" class="image-holder">
       <img src="<?= $book['img_src']; ?>" />
    </a>
    <div class="book-info">
      <div class="form-group">
        <label for="name">Nom:</label>
        <input class="form-control" id="name" name="name" type="text" value="<?= $book['name']; ?>">
      </div>
      <div class="form-group">
        <label for="author">Auteur:</label>
        <input class="form-control" id="author" name="author" type="text" value="<?= $book['author']; ?>">
      </div>
      <div class="form-group">
        <label for="type">Type:</label>
        <select name="type" class="form-control">
        <?php
          foreach ($type->getAll() as $key => $typ) {
            if($typ['id'] === $discover_type['id']){
              echo '<option value="'.$typ['id'].'" selected>'.ucfirst($typ['name']).'</option>';
            }else{
              echo '<option value="'.$typ['id'].'">'.ucfirst($typ['name']).'</option>';
            }
          }
        ?>
        </select>
      </div>
      <div class="form-group">
        <label for="categorie">Catégorie:</label>
        <select name="categorie" class="form-control">
        <?php
          foreach ($category->getAll() as $key => $cat) {
            if($cat['id'] === $discover_cat['id']){
              echo '<option value="'.$cat['id'].'" selected>'.ucfirst($cat['name']).'</option>';
            }else{
              echo '<option value="'.$cat['id'].'">'.ucfirst($cat['name']).'</option>';
            }
          }
        ?>
        </select>
      </div>
      <div class="form-group">
        <label for="spotlight">Mis à la une:</label>
        <select name="spotlight" class="form-control">
          <option value="0" <?= ($book['spotlight'] == 0) ? 'selected' : '' ?>>Non</option>
          <option value="1" <?= ($book['spotlight'] == 1) ? 'selected' : '' ?>>Oui</option>
        </select>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" name="description" id="description"><?= $book['description']; ?></textarea>
      </div>
      <div class="form-group">
        <label for="url_amazon">URL Amazon:</label>
        <input class="form-control" id="url_amazon" name="url_amazon" type="text" value="<?= $book['url_amazon']; ?>">
      </div>
      <button type="submit" class="btn btn-primary">Envoyer</button>
      <a class="btn btn-primary" href="<?= $root; ?>/admin/salons/new">Organiser un salon</a>
    </div>
  </div>

</div>

</form>