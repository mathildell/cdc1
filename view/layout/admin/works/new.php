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
        <label for="helper">Pré-remplissage :</label>
        <select name="helper" id="helper" class="form-control">
          <option value="0">Google books</option>
          <option value="1">Amazon</option>
          <option value="2" selected>Aucun</option>
        </select>
      </div>
      <div class="form-group" id="url_amazon_cont" style="display: none">
        <label for="url_amazon">URL Amazon:</label>
        <div class="input-group basic">
          <input class="form-control" id="url_amazon" name="url_amazon" type="text">
          <span class="input-group-addon"><i class="icon-spinner"></i></span>
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
        <label for="datePublish">Date de publication:</label>
        <input class="form-control datepicker" type="text" id="datePublish" name="datePublish">
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
    </div>
  </div>

</div>

</form>

<script>
$(function(){
  $('.btn-file input').change(function(e) {
      readURL(this);
  });

  var hel_nb = 2;
  $('#helper').change(function(){
    hel_nb = $(this).val();
    if(hel_nb == 0){
      //google books
      if($('#url_amazon_cont').not(':hidden')){
        $('#url_amazon_cont').hide().find('input').val("");
      }
    }else if(hel_nb == 1){
      //amazon
      if($('#url_amazon_cont').is(':hidden')){
        $('#url_amazon_cont').show();
      }
      if($('#name').data('ui-autocomplete') != undefined){
        $('#name').autocomplete("destroy");
      }
    }else{
      if($('#url_amazon_cont').not(':hidden')){
        $('#url_amazon_cont').hide().find('input').val("");
      }
      if($('#name').data('ui-autocomplete') != undefined){
        $('#name').autocomplete("destroy");
      }
    }
  });

  $('#url_amazon').change(function(){
    data = $(this).val();
    if(data.length > 0 && hel_nb == 1){
      $('#url_amazon').parent().removeClass('basic');
      $.ajax({
        url: '<?= $root; ?>/processes/readAmazon',
        data: {'url' : data},
        method: 'POST',
        success: function(answer){
          var json = JSON.parse(answer);
          $('#name').val(json['titre']);
          $('#author').val(json['author']);
          $('#description').val(json['description']);
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

  $('#name').change(function(){
    var val = $.trim($('#name').val());
    if(val.length > 0 && hel_nb == 0){
      string = val.replace(/ /g, '+').toLowerCase();

      $.ajax({
        url: 'https://www.googleapis.com/books/v1/volumes?q='+string,
        success: function(data){
          //var json = JSON.parse(data);
          var autocompleter = [];
          $.each(data.items, function(i, dug){
            console.log(i, dug.volumeInfo.title);

            if(typeof dug.volumeInfo.subtitle !== "undefined"){
              autocompleter.push({"id": i, "category" : dug.volumeInfo.subtitle, "label" : val + " : "+dug.volumeInfo.title });
            }else{
              autocompleter.push({ "id": i, "label" : val + " : "+dug.volumeInfo.title, "category": "" });
            }
            
          });

          $('#name').catcomplete({
              delay: 0,
              source: autocompleter,
              select: function (event, ui) {
                var book = data.items[ui.item.id].volumeInfo;
                $('#name').val(ui.item.label);
                $('#author').val(book.authors[0]);
                $('#description').val(book.description);
                $('#img_src_amazon').val(book.imageLinks.thumbnail);
                $('#uploadImage').attr({'src': book.imageLinks.thumbnail});
                $('#datePublish').val(book.publishedDate);
                //$('#book_id').val(ui.item.id); 
              }
            });

        }


      });
    }
  });


});
</script>