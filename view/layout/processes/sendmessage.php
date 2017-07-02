<?php
  $sender_id = intval(trim($_POST["userid"]));
  $sender_name = htmlspecialchars(trim($_POST["sender_name"]));
  $sender_email = htmlspecialchars(trim($_POST["sender_email"]));
  $receiver_id = intval(trim($_POST["receiver_id"]));
  $timestamp = htmlspecialchars(trim($_POST["timestamp"]));
  $content = nl2br(htmlspecialchars(trim($_POST["msg_content"])));

  if(
    $sender_id > 0 &&
    !empty($sender_name) &&
    !empty($sender_email) &&
    $receiver_id > 0 &&
    !empty($timestamp) &&
    !empty($content)
  ){
  
    $data = [
      ':receiver_id' => $receiver_id,
      ':sender_id' => $sender_id,
      ':sender_name' => $sender_name,
      ':sender_email' => $sender_email,
      ':msg_content' => $content,
      ':unread' => 1,
      ':timestamp' => $timestamp
    ];
    $ac = $user->sendMessage($data);
    if($ac){
      $_SESSION['feedback'] = 'sendmsg_success';
      echo '<script>window.location.replace("'.$root.'/user/'.$sender_id.'/messages");</script>';
    }else{
      $_SESSION['feedback'] = 'sendmsg_failure';
      echo '<script>window.location.replace("'.$root.'/user/'.$sender_id.'/messages/'.$_POST['prev_msg_id'].'");</script>';
    }
  }
?>