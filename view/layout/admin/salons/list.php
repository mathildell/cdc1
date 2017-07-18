<div class="row">
  <div class="col-sm-8">
    <h1 class="intermediate_title">
      <?= $countSalons; ?> salon<?= ($countSalons > 1) ? 's' : ''; ?>
    </h1>
  </div>
  <div class="col-sm-4 align-right">
    <a class="btn btn-primary" href="<?= $root;?>/admin/salons/new">Créer un nouveau salon</a>
  </div>
</div>
</h1>                
<div class="table-responsive">
  <table class="table salon-table data-table">
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
          Salon en cours
        </th>
        <th>
          Modérateur du salon
        </th>
        <th>
          Actions
        </th>
      </tr>
    </thead>
    <tbody id="filter_salons">
    <?php 
      foreach ($salonss as $key => $sal) {
        $workAssoc = $salons->getWorkOfSalon($sal['work_id']);
        $admin = (intval($sal['admin_salon_id']) > 0) ? $user->get($sal['admin_salon_id']) : null;
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
          <?php
          if(strtotime( $sal['date'] ) > time()){
            $diff = strtotime( $sal['date'] ) - time();
            $days=floor($diff/(60*60*24));
            $hours=round(($diff-$days*60*60*24)/(60*60));
            if($days == 0){
              $s = ($hours > 1) ? 's' : '';
              echo ' <i>(dans '.$hours.' heure'.$s.')</i>';
            }else{
              $s = ($days > 1) ? 's' : '';
              echo ' <i>(dans '.$days.' jour'.$s.')</i>';
            }
          }
          ?>
        </td>
        <td>
          <?php
            if($sal['running'] == 1){
            ?>
              <span style="display:none;">a</span> <span class="tag encours">Salon ouvert</span>
            <?php
            }
            ?>
            <span style="display:none;">
              <?= strtotime( $sal['date'] ); ?> 
            </span>
            <?php
            if(strtotime( $sal['date'] ) < time() && $sal['running'] != 1){
            ?>
              <span class="tag">Archivé</span>
            <?php
            }
          ?>
        </td>

        <td>
          <?= !empty($admin) ? '<a href="'.$root.'/user/'.$admin['id'].'">'.ucfirst($admin['username']).'</a>' : ''; ?>
        </td>

        <td>
          <form id="deletesalon_<?= $sal['id']; ?>" action="<?= $root; ?>/processes/deletesalon" method="post" onsubmit="event.preventDefault();"> 
          <?php if(strtotime( $sal['date'] ) < time() && $sal['running'] != 1){ ?>
            <a class="btn btn-default" href="<?= $root.'/salons/'.$sal['id']; ?>">Chat</a>
            <a class="btn btn-default" href="<?= $root.'/admin/salons/'.$sal['id'].'/edit'; ?>">Paramètres</a> 
          <?php }else{ ?>
            <a class="btn btn-primary" href="<?= $root.'/admin/salons/'.$sal['id'].'/edit'; ?>">edit</a> 
          <?php } ?>
          <input type="hidden" name="id" value="<?= $sal['id']; ?>"><input type="submit" class="btn btn-danger" onclick="confirmDelete(<?= $sal['id']; ?>)" value="delete"></form>
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
    document.getElementById('deletesalon_'+id).submit();
  }
  return false;
}
</script>