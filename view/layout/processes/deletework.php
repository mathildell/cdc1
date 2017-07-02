<?php
  if($curr_user['isAdmin'] > 0){

    $rm = $works->update([':is_deleted' => 1, ':id' => $_POST['book_id']]);

    if($rm){
      $_SESSION['feedback'] = 'workdeleted';
    }else{
      $_SESSION['feedback'] = 'workdeleted_error';
    }
    echo '<script>window.location.replace("'.$root.'/admin/works");</script>';
  }else{
    $_SESSION['feedback'] = 'notallowed';
?>
    <script>window.location.replace("<?= $root; ?>/home");</script>
<?php
  }
?>