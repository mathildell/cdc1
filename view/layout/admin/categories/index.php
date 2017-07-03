<?php
if(isset($_SESSION['loggedin']) && $curr_user['isAdmin'] == 1){
  include 'view/layout/includes/breadcrumbs.php';
  $editMode = (isset($_GET['edit'])) ? true : false;
  $newMode = (isset($_GET['new'])) ? true : false;
  $editId = (isset($_GET['id'])) ? $_GET['id'] : false;
  if($editMode){
    $theCat = $category->getOne($editId);
    include 'edit.php';
  }else if($newMode){
    include 'new.php';
  }else{
    $cats = $category->getAll();
    $countCats = count($cats);
    include 'list.php';
  }
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}
?>
