<?php
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
?>
