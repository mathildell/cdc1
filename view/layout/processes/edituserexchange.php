<?php
if(isset($_POST)){
  if($_POST["userid"] == $curr_user['id']){
    $userid = htmlspecialchars(trim($_POST["userid"]));
    $exchange_nbr = intval($_POST["count_exchanges"]);

    if($exchange_nbr > 0){
      for($i = 1; $i <= $exchange_nbr; $i++){
        if(intval($_POST['status_'.$i]) !== 3){
          $data = [
            ':user_id' => $userid,
            ':work_id' => intval($_POST['exchange_workid_'.$i]),
            ':status' => intval($_POST['status_'.$i]),
            ':ex_id' => intval($_POST['exchange_id_'.$i]),
          ];
          $ye = $user->updateExchange($data);
          if($ye){
            $_SESSION['feedback'] = 'exchange_success';
            echo '<script>window.location.replace("'.$root.'/user/'.$userid.'");</script>';
          }else{
            $_SESSION['feedback'] = 'exchange_failure';
            echo '<script>window.location.replace("'.$root.'/user/'.$userid.'/edit");</script>';
          }
        }else{
          $ye = $user->deleteExchange([':ex_id' => intval($_POST['exchange_id_'.$i])]);
          if($ye){
            $_SESSION['feedback'] = 'exchange_success';
            echo '<script>window.location.replace("'.$root.'/user/'.$userid.'");</script>';
          }else{
            $_SESSION['feedback'] = 'exchange_failure';
            echo '<script>window.location.replace("'.$root.'/user/'.$userid.'/edit");</script>';
          }
        }
      }
    }

    if(isset($_POST["add_exchange"])){
      $book = intval($_POST["book"]);
      $status_new = intval($_POST["status_new"]);
      $data = [
        ':user_id' => $userid,
        ':work_id' => $book,
        ':status' => $status_new
      ];
      $new = $user->addExchange($data);
      if($new){
        $_SESSION['feedback'] = 'exchange_success';
        echo '<script>window.location.replace("'.$root.'/user/'.$userid.'");</script>';

      }else{
        $_SESSION['feedback'] = 'exchange_failure';
        echo '<script>window.location.replace("'.$root.'/user/'.$userid.'/edit");</script>';
      }
    } 
      

  }else{
    $_SESSION['feedback'] = 'notallowed';
?>
<script>window.location.replace("<?= $root; ?>/home");</script>
<?php
  }
}else{
  $_SESSION['feedback'] = 'notallowed';
?>
<script>window.location.replace("<?= $root; ?>/home");</script>
<?php
}
?>