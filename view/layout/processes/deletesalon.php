<?php
  if($curr_user['isAdmin'] > 0){
    $rm = $salons->remove($_POST['id']);
    if($rm){
      $_SESSION['feedback'] = 'salondeleted';
    }else{
      $_SESSION['feedback'] = 'salondeleted_error';
    }
    echo '<script>window.location.replace("'.$root.'/admin/salons");</script>';
  }else{
    $_SESSION['feedback'] = 'notallowed';
?>
    <script>window.location.replace("<?= $root; ?>/home");</script>
<?php
  }
?>