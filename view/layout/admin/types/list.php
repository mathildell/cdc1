<h1 class="intermediate_title">
  <?= $countType; ?> type<?= ($countType > 1) ? 's' : ''; ?>
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
          <a class="btn btn-primary" href="<?= $root.'/admin/types/'.$type['id'].'/edit'; ?>">edit</a>
          <a class="btn btn-danger">delete</a>
        </td>
      </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
</div>