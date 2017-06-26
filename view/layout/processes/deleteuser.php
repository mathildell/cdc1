<?php
  if($curr_user['isAdmin'] > 0){
    $rm = $user->removeUser($_POST['id']);
    if($rm){
      $_SESSION['feedback'] = 'userdeleted';
      echo '<script>window.location.replace("'.$root.'/users");</script>';

    }else{
      //Erreur database
    }
  }else{
    $_SESSION['feedback'] = 'notallowed';
?>
    <script>window.location.replace("<?= $root; ?>/home");</script>
<?php
  }
?>