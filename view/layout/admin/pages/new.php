<form class="form" method="post" id="form_edit">
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" class="form-control">
      </div>
    </div>
    <!--
    <div class="col-sm-6">
      <div class="form-group">
        <label for="is_footer_link">Lien dans footer:</label>
        <select name="is_footer_link" id="is_footer_link" class="form-control">
          <option value="0" disabled>Non</option>
          <option value="1" selected disabled>Oui</option>
        </select>
      </div>
    </div>
    -->
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="form-group">
        <label for="content">Contenu de la page:</label>
        <?php include 'toolbar.php'; ?>
        <div id="content" name="content" class="form-control" style="height:200px; overflow: auto;"></div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 align-right">
      <button type="submit" class="btn btn-primary">Créer</button>
    </div>
  </div>
</form>
<script>
$(function(){
  $('#content').wysiwyg();

  $('#form_edit').submit(function(e){
    e.preventDefault();
    $.ajax({
      url: '<?= $root; ?>/processes/createpage',
      method: 'POST',
      data: {'name': $('#name').val(), 'content': $('#content').html() },
      success: function(){
        window.location.href = '<?= $root; ?>/admin/pages';
      }
    });
  });
});
</script>