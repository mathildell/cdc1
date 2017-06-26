<?php
  include 'view/layout/includes/breadcrumbs.php';
  $editMode = (isset($_GET['edit'])) ? true : false;
  $editId = (isset($_GET['id'])) ? $_GET['id'] : false;
  if($editMode){
    $theUser = $user->get($editId);
    include 'edit.php';
  }else{
    $allUsers = $user->getAll();
    $countUsers = count($allUsers);
    include 'list.php';
  }
?>
