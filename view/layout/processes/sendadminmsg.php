<?php
if(isset($_POST)){
  $sender_name = htmlspecialchars(trim($_POST["sender_name"]));
  $sender_email = htmlspecialchars(trim($_POST["sender_email"]));
  $sender_subject = htmlspecialchars(trim($_POST["sender_subject"]));
  $timestamp = htmlspecialchars(trim($_POST["timestamp"]));
  $content = nl2br(htmlspecialchars(trim($_POST["msg_content"])));

  if(
    !empty($sender_name) &&
    !empty($sender_email) &&
    !empty($sender_subject) &&
    !empty($content) &&
    !empty($timestamp)
  ){
    $data = [
      ':sender_name' => $sender_name,
      ':sender_email' => $sender_email,  
      ':topic' => $sender_subject,
      ':msg_content' => $content, 
      ':unread' => 1, 
      ':timestamp' => $timestamp
    ];

    if(!empty($_POST["sender_id"])){
      $sender_id = intval(trim($_POST["sender_id"]));
      $data[':sender_id'] = $sender_id;
    }

    $send = $user->sendMessageToAdmin($data);

    if($send){
      $_SESSION['feedback'] = 'sendmsg_success';
    }else{
      $_SESSION['feedback'] = 'sendmsg_failure';
    }
    echo '<script>window.location.replace("'.$root.'/contact");</script>';

  }else{
    $_SESSION['feedback'] = 'sendmsg_failure';
    echo '<script>window.location.replace("'.$root.'/contact");</script>';
  }
}else{
  $_SESSION['feedback'] = 'notallowed';
?>
<script>window.location.replace("<?= $root; ?>/home");</script>
<?php
}
?>