<?php
if($_SESSION['loggedin']){
  $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : '';
  $salon_id = isset($_POST['salon_id']) ? intval($_POST['salon_id']) : '';
  $message = isset($_POST["message"]) ? nl2br(htmlspecialchars(trim($_POST["message"]))) : '';
  $timestamp = date('Y-m-d H:i:s');
  if(
    !empty($message)
  ){
    $data = [
      ':salon_id' => $salon_id,
      ':user_id' => $user_id,
      ':messages' => $message,
      ':timestamp' => $timestamp
    ];
    $salons->sendChatMessage($data);
  }
  
}
?>