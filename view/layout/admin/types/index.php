<?php
  include 'view/layout/includes/breadcrumbs.php';
  $editMode = (isset($_GET['edit'])) ? true : false;
  $editId = (isset($_GET['id'])) ? $_GET['id'] : false;
  if($editMode){
    $theType = $type->getOne($editId);
    include 'edit.php';
  }else{
    $typess = $type->getAll();
    $countType = count($typess);
    include 'list.php';
  }
?>
