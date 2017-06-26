<h1 class="intermediate_title">
  <?= $countSalons; ?> salon<?= ($countSalons > 1) ? 's' : ''; ?>
</h1>                
<div class="table-responsive">
  <table class="table user-table">
    <thead>
      <tr>
        <th>
          ID
        </th>
        <th>
          Oeuvre &amp; auteur
        </th>
        <th>
          Date
        </th>
        <th>
          Actions
        </th>
      </tr>
    </thead>
    <tbody>
    <?php 
      foreach ($salonss as $key => $sal) {
        $workAssoc = $salons->getWorkOfSalon($sal['work_id']);
        $bookType = $works->getBookType($workAssoc['id'])['name'];
        $bookGenre = $works->getBookCat($workAssoc['id'])['name'];
    ?>
      <tr>
        <td>
          <?= isset($sal['id']) ? $sal['id'] : ''; ?>
        </td>
        <td>
          <?= '<a href="'. $root . '/discover/' . $bookType . '/' . $bookGenre . '/' . $workAssoc['id'] . '">' . $workAssoc['name'] . '</a> <p>par ' . $workAssoc['author'] .'</p>'; ?>
        </td>
        <td>
          <?= date( 'l jS F Y\, H\hi', strtotime( $sal['date'] )); ?>
        </td>
        <td>
          <a class="btn btn-primary" href="<?= $root.'/admin/salons/'.$sal['id'].'/edit'; ?>">edit</a>
          <a class="btn btn-danger">delete</a>
        </td>
      </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
</div>