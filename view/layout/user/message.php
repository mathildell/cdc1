<?php 
  //include 'view/layout/includes/breadcrumbs.php';
?>
<div class="user_messages">
<?php
  if(isset($_GET['msg_id'])){
    $msg = $user->getUserMessage($_GET['msg_id']);
?>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="sender_name">Nom</label>
      <input type="text" name="sender_name" id="sender_name" class="form-control" value="<?= $msg['sender_name']; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="sender_email">Email</label>
      <input type="text" name="sender_email" id="sender_email" class="form-control" value="<?= $msg['sender_email']; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="sender_timestamp">Date d'envoi</label>
      <input type="text" name="timestamp" id="sender_timestamp" class="form-control" value="<?= date( 'l jS F Y \à H\hi', strtotime( $msg['timestamp'] )); ?>" readonly>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="msg_content">Contenu du message</label>
      <textarea rows="9" name="msg_content" id="msg_content" class="form-control" readonly><?= html_entity_decode($msg['msg_content']); ?></textarea>
    </div>
  </div>
</div>
<?php 
  if($msg['sender_id'] !== $curr_user['id']){
    echo '<br> <hr> <br> ';
?>
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

  <input type="hidden" name="prev_msg_id" value="<?= $msg['id']; ?>">

  <input type="hidden" name="userid" value="<?= $curr_user['id']; ?>">
  <input type="hidden" name="receiver_id" value="<?= $msg['sender_id']; ?>">
  <input type="hidden" name="timestamp" value="<?= date('Y-m-d H:i:s'); ?>">
  <div class="row">
    <div class="col-sm-12 align-right">
      <button class="btn btn-primary" type="submit">Répondre</button>
    </div>
  </div>
</form>
<?php
  }
?>


<?php

  }else{

  $messages = $user->getUserMessages($curr_user['id']);
  $messgaesCount = count($messages);
  $messagesSent = $user->getUserSentMessages($curr_user['id']);
  $messgaesSentCount = count($messagesSent);
if($messgaesCount > 0 || $messgaesSentCount > 0){

  if($messgaesCount > 0){

?>
<div class="row">
  <div class="col-sm-8">
    <h1 class="intermediate_title">
      <?= $messgaesCount; ?> message<?= ($messgaesCount > 1) ? 's' : ''; ?> reçu<?= ($messgaesCount > 1) ? 's' : ''; ?>
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
          Message
        </th>
        <th>
          Timestamp
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
      foreach ($messages as $key => $msg) {
    ?>
      <tr>
        <td>
          <?= isset($msg['sender_name']) ? '<a href="'.$root.'/user/'.$msg['sender_id'].'">'.$msg['sender_name'].'</a>' : ''; ?>
        </td>
        <td>
          <?= isset($msg['sender_email']) ? $msg['sender_email'] : ''; ?>
        </td>
        <td>
          <?= isset($msg['msg_content']) ? substr($msg['msg_content'], 0, 50).'...' : ''; ?>
        </td>
        <td>
          <?= isset($msg['timestamp']) ? '<span style="display:none;">'.strtotime( $msg['timestamp'] ).'</span>'.date( 'l jS F Y \à H\hi', strtotime( $msg['timestamp'] )) : ''; ?>
        </td>
        <td>
          <?= intval($msg['unread']) === 1 ? '<span class="unread"></span>' : ''; ?>
        </td>
        <td>
          <a href="<?= $root;?>/user/<?= $curr_user['id']; ?>/messages/<?= $msg['id']; ?>" class="btn btn-primary">Voir</a>
        </td>
      </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
</div>
<?php
}
if($messgaesSentCount > 0){
    if($messgaesCount > 0){
      echo '<br> <hr> <br> ';
    }
      
?>
<div class="row">
  <div class="col-sm-8">
    <h1 class="intermediate_title">
      <?= $messgaesSentCount; ?> message<?= ($messgaesSentCount > 1) ? 's' : ''; ?> envoyé<?= ($messgaesSentCount > 1) ? 's' : ''; ?>
    </h1>     
  </div>
</div>          
<div class="table-responsive">
  <table class="table data-table">
    <thead>
      <tr>
        <th>
          Nom du receveur
        </th>
        <th>
          Email du receveur
        </th>
        <th>
          Message
        </th>
        <th>
          Timestamp
        </th>
        <th>
          Actions
        </th>
      </tr>
    </thead>
    <tbody>
    <?php 
      foreach ($messagesSent as $key => $msg) {
        $receiver = $user->get($msg['receiver_id']);
    ?>
      <tr>
        <td>
          <?= isset($msg['receiver_id']) ? '<a href="'.$root.'/user/'.$receiver['id'].'">'.$receiver['username'].'</a>' : ''; ?>
        </td>
        <td>
          <?= isset($receiver['email']) ? $receiver['email'] : ''; ?>
        </td>
        <td>
          <?= isset($msg['msg_content']) ? substr($msg['msg_content'], 0, 50).'...' : ''; ?>
        </td>
        <td>
          <?= isset($msg['timestamp']) ? '<span style="display:none;">'.strtotime( $msg['timestamp'] ).'</span>'.date( 'l jS F Y \à H\hi', strtotime( $msg['timestamp'] )) : ''; ?>
        </td>
        <td>
          <a href="<?= $root;?>/user/<?= $curr_user['id']; ?>/messages/<?= $msg['id']; ?>" class="btn btn-primary">Voir</a>
        </td>
      </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
</div>
<?php
  }
}else{
  echo '<h1 class="intermediate_title">Aucun message</h1> <p>Vous pouvez contacter d\'autres utilisateurs en visitant leurs profils.</p>';
}
}
?>
</div>

