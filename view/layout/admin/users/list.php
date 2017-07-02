<div class="row">
  <div class="col-sm-8">
    <h1 class="intermediate_title">
      <?= $countUsers; ?> utilisateur<?= ($countUsers > 1) ? 's' : ''; ?>
    </h1>   
  </div>
  <div class="col-sm-4 align-right">
    <a class="btn btn-primary" href="<?= $root;?>/admin/users/new">Créer un nouvel utilisateur</a>
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
          Email
        </th>
        <th style="width: 30%;">
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
          <a href="<?= $root; ?>/user/<?= isset($theUser['id']) ? $theUser['id'] : ''; ?>"><?= isset($theUser['username']) ? $theUser['username'] : ''; ?></a>
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
          <form id="deleteuser_<?= $theUser['id']; ?>" action="<?= $root; ?>/processes/deleteuser" method="post" onsubmit="event.preventDefault();"><a class="btn btn-primary" href="<?= $root.'/admin/users/'.$theUser['id'].'/edit'; ?>">edit</a><input type="hidden" name="id" value="<?= $theUser['id']; ?>"><input type="submit" class="btn btn-danger" onclick="confirmDelete(<?= $theUser['id']; ?>)" value="delete"></form>
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
    document.getElementById('deleteuser_'+id).submit();
  }
  return false;
}
</script>