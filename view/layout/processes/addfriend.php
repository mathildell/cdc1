<?php
if(isset($_SESSION['loggedin']) && isset($_POST)){
  $friend_id = isset($_POST["friend_id"]) ? intval(trim($_POST["friend_id"])) : '';
  $userid = isset($curr_user['id']) ? intval($curr_user['id']) : '';
  $username = isset($curr_user['username']) ? intval($curr_user['username']) : '';
  if(
    $friend_id > 0 && $userid > 0
  ){
    $data = [
      ':user_1_id' => $userid,
      ':user_2_id' => $friend_id
    ];

    $msg = $username." vous a ajouté en tant que contact sur le <a href=\"http://clubcritique.tk/\">Club des Critiques</a>. Consultez <a href=\"http://clubcritique.tk/user/".$friend_id."\">leur profil</a> !";
    $msg = wordwrap($msg,70);
    $subject = $username." vous a ajouté en contact !";
    $headers = "From: mathildelucelucas@gmail.com";
    mail($email,$subject,$msg,$headers);

    $friendly = $user->newFriend($data);

    if($friendly){
      $_SESSION['feedback'] = 'addfriend_success';
    }else{
      $_SESSION['feedback'] = 'addfriend_failure';
    }

  }else{
    $_SESSION['feedback'] = 'addfriend_failure';
  }
  echo '<script>window.location.replace("'.$root.'/user/'.$friend_id.'");</script>';
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}