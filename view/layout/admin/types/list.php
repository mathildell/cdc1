<div class="row">
  <div class="col-sm-8">
    <h1 class="intermediate_title">
      <?= $countType; ?> type<?= ($countType > 1) ? 's' : ''; ?>
    </h1>     
  </div>
  <div class="col-sm-4 align-right">
    <a class="btn btn-primary" href="<?= $root;?>/admin/types/new">Créer un nouveau type</a>
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
      foreach ($typess as $key => $type) {
    ?>
      <tr>
        <td>
          <?= isset($type['id']) ? $type['id'] : ''; ?>
        </td>
        <td>
          <?= isset($type['name']) ? $type['name'] : ''; ?>
        </td>
        <td>
          <form id="deletetype_<?= $type['id']; ?>" action="<?= $root; ?>/processes/deletetype" method="post" onsubmit="event.preventDefault();"><a class="btn btn-primary" href="<?= $root.'/admin/types/'.$type['id'].'/edit'; ?>">edit</a><input type="hidden" name="id" value="<?= $type['id']; ?>"><input type="submit" class="btn btn-danger" onclick="confirmDelete(<?= $type['id']; ?>)" value="delete"></form>
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
    document.getElementById('deletetype_'+id).submit();
  }
  return false;
}
</script>