<?php
if($_SESSION['loggedin']){
  foreach ($_POST['data'] as $key => $friendId) {
    $message = '<a href="'.$root.'/user/'.$_POST['userid'].'">'.$_POST['username'].'</a> vous a invité a participer au salon du '.$_POST['salonDate'].' sur l\'oeuvre '.$_POST['salonName'].'<br>Vous pouvez vous inscrire et retrouver toutes les informations au sujet de ce salon <a href="'.$root.'/salons/'.$_POST['salonId'].'">à cette adresse.</a><br><br>Au plaisir d\'entendre votre avis,<br>L\'équipe Club des Critiques.';
    $data = [
      ':receiver_id' => $friendId,
      ':sender_id' => $_POST['userid'],
      ':sender_name' => ucfirst($_POST['username']),
      //'salonName':salonName,'salonId':salonId,'salonDate':salonDate
      ':sender_email' => $_POST['useremail'],
      ':msg_content' => $message,
      ':unread' => 1,
      ':timestamp' => $_POST['timestamp']
    ];

    return $ac = $user->sendMessage($data);
  }
}
?>