<?php
  if($curr_user['isAdmin'] > 0){
    $rm = $pages->delete($_POST['id']);
    if($rm){
      $_SESSION['feedback'] = 'pagedeleted_success';
    }else{
      $_SESSION['feedback'] = 'pagedeleted_error';
    }
    echo '<script>window.location.replace("'.$root.'/admin/pages");</script>';
  }else{
    $_SESSION['feedback'] = 'notallowed';
?>
    <script>window.location.replace("<?= $root; ?>/home");</script>
<?php
  }
?>