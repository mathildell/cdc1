<form class="form" method="post" action="<?= $root ?>/processes/newwork" enctype="multipart/form-data">
  <div class="row">
  <div class="col-sm-12 book-card book-xl">
    <div class="image-holder">
       <img src="<?= $root; ?>/view/assets/img/no-preview.png" id="uploadImage"/>
      <label class="btn btn-default btn-file">
            <span class="icon-picture-streamline"></span>
          Browse <input type="file" name="img_src" style="display: none;">
          <input type="hidden" id="img_src_amazon" name="img_src_amazon" value="">
      </label>
    </div>

    <div class="book-info">
      <div class="form-group">
        <label for="url_amazon">URL Amazon:</label>
        <div class="input-group basic">
          <input class="form-control" id="url_amazon" name="url_amazon" type="text">
          <span class="input-group-addon"><i class="icon-search"></i></span>
        </div>
      </div>
      <div class="form-group">
        <label for="name">Nom:</label>
        <input class="form-control" id="name" name="name" type="text">
      </div>
      <div class="form-group">
        <label for="author">Auteur:</label>
        <input class="form-control" id="author" name="author" type="text">
      </div>
      <div class="form-group">
        <label for="type">Type:</label>
        <select name="type_id" class="form-control">
        <?php
          foreach ($type->getAll() as $key => $typ) {
            echo '<option value="'.$typ['id'].'">'.ucfirst($typ['name']).'</option>';
          }
        ?>
        </select>
      </div>
      <div class="form-group">
        <label for="categorie">Catégorie:</label>
        <select name="cat_id" class="form-control">
        <?php
          foreach ($category->getAll() as $key => $cat) {
            echo '<option value="'.$cat['id'].'">'.ucfirst($cat['name']).'</option>';
          }
        ?>
        </select>
      </div>
      <div class="form-group">
        <label for="spotlight">Mis à la une:</label>
        <select name="spotlight" class="form-control">
          <option value="0">Non</option>
          <option value="1">Oui</option>
        </select>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" name="description" id="description"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Envoyer</button>
      <a class="btn btn-primary" href="<?= $root; ?>/admin/salons/new">Organiser un salon</a>
    </div>
  </div>

</div>

</form>

<script>
$(function(){
  $('.btn-file input').change(function(e) {
      readURL(this);
  });

  $('#url_amazon').change(function(){
    data = $(this).val();
    if(data.length > 0){
      $('#url_amazon').parent().removeClass('basic');
      $.ajax({
        url: '<?= $root; ?>/processes/readAmazon',
        data: {'url' : data},
        method: 'POST',
        success: function(answer){
          var json = JSON.parse(answer);
          $('#name').val(json['titre']);
          $('#author').val(json['author']);
          $('#img_src_amazon').val(json['src']);
          $('#uploadImage').attr({'src': json['src']});
          $('#url_amazon').parent().addClass('basic');
        }
      });
    }else{
      if(!$('#url_amazon').parent().hasClass('basic')){
          $('#url_amazon').parent().addClass('basic');
      }
    }
  });



});
</script>