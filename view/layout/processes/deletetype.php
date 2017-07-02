<?php
  if($curr_user['isAdmin'] > 0){
    $rm = $type->removeType([':id' => $_POST['id']]);
    if($rm){
      $_SESSION['feedback'] = 'typedeleted_success';
    }else{
      $_SESSION['feedback'] = 'typedeleted_failure';
    }
    echo '<script>window.location.replace("'.$root.'/admin/types");</script>';
  }else{
    $_SESSION['feedback'] = 'notallowed';
?>
    <script>window.location.replace("<?= $root; ?>/home");</script>
<?php
  }
?>