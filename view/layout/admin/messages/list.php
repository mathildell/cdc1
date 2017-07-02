<div class="row">
  <div class="col-sm-8">
    <h1 class="intermediate_title">
      <?= $allMessagesCount; ?> message<?= ($allMessagesCount > 1) ? 's' : ''; ?>
    </h1>   
  </div>
</div>             
<div class="table-responsive">
  <table class="table data-table">
    <thead>
      <tr>
        <th>
          Nom
        </th>
        <th>
          Email
        </th>
        <th>
          Sujet du mail
        </th>
        <th>
          Date
        </th>
        <th>
          Lu
        </th>
        <th>
          Actions
        </th>
      </tr>
    </thead>
    <tbody>
    <?php 
      foreach ($allMessages as $key => $msg) {
    ?>
      <tr>
        <td>
          <?= isset($msg['sender_name']) ? $msg['sender_name'] : ''; ?>
        </td>
        <td>
          <?= isset($msg['sender_email']) ? $msg['sender_email'] : ''; ?>
        </td>
        <td>
          <?= isset($msg['topic']) ? $msg['topic'] : ''; ?>
        </td>
        <td>
          <?= isset($msg['timestamp']) ? '<span style="display: none;">'.strtotime($msg['timestamp']).'</span>'.date( 'l jS F Y \à H\hi', strtotime( $msg['timestamp'] )) : ''; ?>
        </td>
        <td>
          <?= (intval($msg['unread']) === 1) ? '<span class="unread"></span>' : ''; ?>
        </td>
        <td>
          <a href="<?= $root; ?>/admin/messages/<?= isset($msg['id']) ? $msg['id'] : ''; ?>" class="btn btn-primary">Voir</a>
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