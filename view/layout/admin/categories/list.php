<h1 class="intermediate_title">
  <?= $countCats; ?> catégorie<?= ($countCats > 1) ? 's' : ''; ?>
</h1>                
<div class="table-responsive">
  <table class="table user-table">
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
          <a class="btn btn-primary" href="<?= $root.'/admin/categories/'.$cat['id'].'/edit'; ?>">edit</a>
          <a class="btn btn-danger">delete</a>
        </td>
      </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
</div>