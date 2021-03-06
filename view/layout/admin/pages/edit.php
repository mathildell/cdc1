<form class="form" method="post" id="form_edit">
  <input type="hidden" name="id" id="page_id" value="<?= $thePage['id']; ?>">
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" class="form-control" value="<?= $thePage['name']; ?>">
      </div>
    </div>
    
    <?php if(intval($thePage['id']) !== 3 && intval($thePage['id']) !== 4 && intval($thePage['id']) !== 5 ){ ?>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="is_draft">Brouillon:</label>
        <select name="is_draft" id="is_draft" class="form-control">
          <option value="0" <?= (intval($thePage['is_draft']) === 0) ? 'selected' : ''?>>Non</option>
          <option value="1" <?= (intval($thePage['is_draft']) === 1) ? 'selected' : ''?>>Oui</option>
        </select>
      </div>
    </div>
    <?php } ?>
    
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="form-group">
        <label for="content">Contenu de la page:</label>
        <?php include 'toolbar.php'; ?>
        <div id="content" name="content" class="form-control" style="height:200px; overflow: auto;">
          <?= ($thePage['id'] != 3) ? htmlspecialchars_decode($thePage['content']) : $thePage['content']; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 align-right">
      <button type="submit" class="btn btn-primary">Modifier</button>
    </div>
  </div>
</form>
<script>
$(function(){
  $('#content').wysiwyg();
  $('#form_edit').submit(function(e){
    e.preventDefault();
    $.ajax({
      url: '<?= $root; ?>/processes/editpage',
      method: 'POST',
      data: {'name': $('#name').val(), 'is_footer_link': $('#is_footer_link').val(), 'id': $('#page_id').val(), 'content': $('#content').html(), 'is_draft': $('#is_draft').val() },
      success: function(){
        window.location.href = '<?= $root; ?>/admin/pages/'+$('#page_id').val()+'/edit';
      }
    });
  });
});
</script>