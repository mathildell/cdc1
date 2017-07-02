<div class="row">
  <div class="col-sm-8">
    <h1 class="intermediate_title">
      <?= $countCats; ?> catégorie<?= ($countCats > 1) ? 's' : ''; ?>
    </h1>   
  </div>
  <div class="col-sm-4 align-right">
    <a class="btn btn-primary" href="<?= $root;?>/admin/categories/new">Créer une nouvelle categorie</a>
  </div>
</div>             
<div class="table-responsive">
  <table class="table data-table">
    <thead>
      <tr>
        <th>
          ID
        </th>
        <th>
          Nom
        </th>
        <th>
          Actions
        </th>
      </tr>
    </thead>
    <tbody>
    <?php 
      foreach ($cats as $key => $cat) {
    ?>
      <tr>
        <td>
          <?= isset($cat['id']) ? $cat['id'] : ''; ?>
        </td>
        <td>
          <?= isset($cat['name']) ? $cat['name'] : ''; ?>
        </td>
        <td>
          <form id="deletecat_<?= $cat['id']; ?>" action="<?= $root; ?>/processes/deletecat" method="post" onsubmit="event.preventDefault();"><a class="btn btn-primary" href="<?= $root.'/admin/categories/'.$cat['id'].'/edit'; ?>">edit</a><input type="hidden" name="id" value="<?= $cat['id']; ?>"><input type="submit" class="btn btn-danger" onclick="confirmDelete(<?= $cat['id']; ?>)" value="delete"></form>
        </td>
      </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
</div>
<script>
function confirmDelete(id){
  if(confirm('Are you sure?')){
    document.getElementById('deletecat_'+id).submit();
  }
  return false;
}
</script>