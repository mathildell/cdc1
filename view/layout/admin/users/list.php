<h1 class="intermediate_title">
  <?= $countUsers; ?> utilisateur<?= ($countUsers > 1) ? 's' : ''; ?>
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
          Email
        </th>
        <th>
          Description
        </th>
        <th>
          Photo
        </th>
        <th>
          Est admin
        </th>
        <th>
          Action
        </th>
      </tr>
    </thead>
    <tbody>
    <?php 
      foreach ($allUsers as $key => $theUser) {
    ?>
      <tr>
        <td>
          <?= isset($theUser['id']) ? $theUser['id'] : ''; ?>
        </td>
        <td>
          <?= isset($theUser['username']) ? $theUser['username'] : ''; ?>
        </td>
        <td>
          <?= isset($theUser['email']) ? $theUser['email'] : ''; ?>
        </td>
        <td>
          <?= isset($theUser['description']) ? $theUser['description'] : ''; ?>
        </td>
        <td>
          <img src="<?= isset($theUser['picture']) ? $root.'/'.$theUser['picture'] : ''; ?>" alt="<?= isset($theUser['username']) ? $theUser['username'] : ''; ?>">
        </td>
        <td>
          <?= ($theUser['isAdmin'] == 0) ? 'Non' : 'Oui'; ?>
        </td>
        <td>
          <form id="deleteuser" action="<?= $root; ?>/processes/deleteuser" method="post" onsubmit="event.preventDefault();"><a class="btn btn-primary" href="<?= $root.'/admin/users/'.$theUser['id'].'/edit'; ?>">edit</a><input type="hidden" name="id" value="<?= $theUser['id']; ?>"><input type="submit" class="btn btn-danger" onclick="confirmDelete()" value="delete"></form>
          
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
    document.getElementById('deleteuser').submit();
  }
  return false;
}
</script>