<div class="row">
  <div class="col-sm-8">
    <h1 class="intermediate_title">
      <?= $countPages; ?> élément<?= ($countPages > 1) ? 's' : ''; ?> éditable<?= ($countPages > 1) ? 's' : ''; ?>
    </h1>   
  </div>
  <div class="col-sm-4 align-right">
    <a class="btn btn-primary" href="<?= $root; ?>/admin/pages/new">
      Nouvelle page statique
    </a>
  </div>
</div>             
<div class="table-responsive">
  <table class="table user-table data-table">
    <thead>
      <tr>
        <th>
          ID
        </th>
        <th>
          Nom
        </th>
        <th>
          Contenu
        </th>
        <th>
          Est une page complète
        </th>
        <th>
          Actions
        </th>
      </tr>
    </thead>
    <tbody>
    <?php 
      foreach ($pagess as $key => $page) {
    ?>
      <tr>
        <td>
          <?= isset($page['id']) ? $page['id'] : ''; ?>
        </td>
        <td>
          <?= isset($page['name']) ? $page['name'] : ''; ?>
        </td>
        <td>
          <?= isset($page['content']) ? substr($page['content'], 0, 50).'...' : ''; ?>
        </td>
        <td>
          <?= (intval($page['is_footer_link']) === 1) ? 'Oui' : 'Non'; ?>
        </td>
        <td>
        <form id="deletepage_<?= $page['id']; ?>" action="<?= $root; ?>/processes/deletepage" method="post" onsubmit="event.preventDefault();">
            <a class="btn btn-primary" href="<?= $root.'/admin/pages/'.$page['id'].'/edit'; ?>">edit</a>
            <input type="hidden" name="id" value="<?= $page['id']; ?>"><input type="submit" class="btn btn-danger" onclick="confirmDelete(<?= $page['id']; ?>)" value="delete"> 
          </form>
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
    document.getElementById('deletepage_'+id).submit();
  }
  return false;
}
</script>