<?php
if(isset($_SESSION['loggedin'])){
  include 'view/layout/includes/breadcrumbs.php';
  $editMode = (isset($_GET['edit'])) ? true : false;
  $newMode = (isset($_GET['new'])) ? true : false;
  $editId = (isset($_GET['id'])) ? $_GET['id'] : false;
  if($editMode){
    $salon = $salons->getOne($editId);
    if($curr_user['isAdmin'] == 1 || $salon['admin_salon_id'] == $curr_user['id']){
      $workAssoc = $salons->getWorkOfSalon($salon['work_id']);
      $adminSalon = $user->get($salon['admin_salon_id']);
      $bookType = $works->getBookType($workAssoc['id'])['name'];
      $bookGenre = $works->getBookCat($workAssoc['id'])['name'];
      include 'edit.php';
    }else{
      $_SESSION['feedback'] = 'notallowed';
      echo '<script>window.location.replace("'.$root.'/home");</script>';
    }
  }else if($newMode){
    if($curr_user['isAdmin'] == 1){
      include 'new.php';
    }else{
      $_SESSION['feedback'] = 'notallowed';
      echo '<script>window.location.replace("'.$root.'/home");</script>';
    }
  }else{
    if($curr_user['isAdmin'] == 1){
      $salonss = $salons->getAll();
      $countSalons = count($salonss);
      include 'list.php';
    }else{
      $_SESSION['feedback'] = 'notallowed';
      echo '<script>window.location.replace("'.$root.'/home");</script>';
    }
  }
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}
?>
