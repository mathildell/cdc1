<?php
  if($curr_user['isAdmin'] > 0){
    $rm = $user->removeUser($_POST['id']);
    if($rm){
      $_SESSION['feedback'] = 'userdeleted';
    }else{
      $_SESSION['feedback'] = 'userdeleted_error';
    }
    echo '<script>window.location.replace("'.$root.'/admin/users");</script>';
  }else{
    $_SESSION['feedback'] = 'notallowed';
?>
    <script>window.location.replace("<?= $root; ?>/home");</script>
<?php
  }
?>