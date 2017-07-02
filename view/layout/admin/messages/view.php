<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="sender_name">Nom</label>
      <input type="text" name="sender_name" id="sender_name" class="form-control" value="<?= $message['sender_name']; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="sender_email">Email</label>
      <input type="text" name="sender_email" id="sender_email" class="form-control" value="<?= $message['sender_email']; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="sender_timestamp">Date d'envoi</label>
      <input type="text" name="timestamp" id="sender_timestamp" class="form-control" value="<?= date( 'l jS F Y \à H\hi', strtotime( $message['timestamp'] )); ?>" readonly>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="msg_content">Contenu du message</label>
      <textarea rows="9" name="msg_content" id="msg_content" class="form-control" readonly><?= html_entity_decode($message['msg_content']); ?></textarea>
    </div>
  </div>
</div>

<br> <hr> <br> 
<h3 class="intermediate_title">Répondre</h3>
<form class="form" method="post" action="<?= $root;?>/processes/sendmessage">
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="sender_name">Nom</label>
        <input type="text" name="sender_name" id="sender_name" class="form-control" value="<?= $curr_user['username']; ?>">
      </div>
      <div class="form-group">
        <label for="sender_email">Email</label>
        <input type="text" name="sender_email" id="sender_email" class="form-control" value="<?= $curr_user['email']; ?>">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="msg_content">Contenu du message</label>
        <textarea rows="5" name="msg_content" id="msg_content" class="form-control"></textarea>
      </div>
    </div>
  </div>

  <input type="hidden" name="prev_msg_id" value="<?= $message['id']; ?>">

  <input type="hidden" name="userid" value="<?= $curr_user['id']; ?>">
  <input type="hidden" name="receiver_id" value="<?= $message['sender_id']; ?>">
  <input type="hidden" name="timestamp" value="<?= date('Y-m-d H:i:s'); ?>">
  <div class="row">
    <div class="col-sm-12 align-right">
      <button class="btn btn-primary" type="submit">Répondre</button>
    </div>
  </div>
</form>