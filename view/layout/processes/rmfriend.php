<?php
if(isset($_POST)){
    $friend_id = isset($_POST["friend_id"]) ? intval(trim($_POST["friend_id"])) : '';
    $friendship_id = isset($_POST["friendship_id"]) ? intval(trim($_POST["friendship_id"])) : '';
    if(
      !empty($friend_id) && !empty($friendship_id)
    ){
      $data = [
        ':id' => $friendship_id
      ];

      $friendly = $user->deleteFriend($data);
      if($friendly){
        $_SESSION['feedback'] = 'rmfriend_success';
      }else{
        $_SESSION['feedback'] = 'rmfriend_failure';
      }

    }else{
      $_SESSION['feedback'] = 'rmfriend_failure';
    }
    echo '<script>window.location.replace("'.$root.'/user/'.$friend_id.'");</script>';
  }else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}