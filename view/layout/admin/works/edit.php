<form class="form" method="post" action="<?= $root ?>/processes/editwork" enctype="multipart/form-data">
  <div class="row">
  <div class="col-sm-12 book-card book-xl">
    <div class="image-holder">
       <img src="<?= $book['img_src']; ?>" id="uploadImage" />
      <label class="btn btn-default btn-file">
            <span class="icon-picture-streamline"></span>
          Browse <input type="file" name="img_src" style="display: none;">
      </label>
    </div>

    <div class="book-info">
      <input id="work_id" name="work_id" type="hidden" value="<?= $book['id']; ?>">
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
        <select name="type_id" id="type" class="form-control">
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
        <select id="categorie" name="cat_id" class="form-control">
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
        <select id="spotlight" name="spotlight" class="form-control">
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
      <div class="form-group align-right">
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </div>
    </div>
  </div>

</div>

</form>
<script>
$(function(){
  $('.btn-file input').change(function(e) {
      readURL(this);
  });
});
</script>