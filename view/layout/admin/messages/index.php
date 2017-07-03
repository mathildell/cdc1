<?php
if(isset($_SESSION['loggedin']) && $curr_user['isAdmin'] == 1){
  include 'view/layout/includes/breadcrumbs.php';
  $editId = (isset($_GET['id'])) ? $_GET['id'] : false;
  if($editId){
    $message = $user->getAdminEmail($editId);
    if(intval($message['unread']) === 1){
      $user->sendReadNotif("admin_messages", $editId);
    }
    include 'view.php';
  }else{
    $allMessages = $user->getAllAdminEmails();
    $allMessagesCount = count($allMessages);
    include 'list.php';
  }
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}
?>
