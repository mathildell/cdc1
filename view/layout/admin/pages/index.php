<?php
  include 'view/layout/includes/breadcrumbs.php';
  $editMode = (isset($_GET['edit'])) ? true : false;
  $editId = (isset($_GET['id'])) ? $_GET['id'] : false;
  $newMode = (isset($_GET['new'])) ? true : false;
  if($editMode){
    $thePage = $pages->getOne($editId);
    include 'edit.php';
  }else if($newMode){
    include 'new.php';
  }else{
    $pagess = $pages->getAll();
    $countPages = count($pagess);
    include 'list.php';
  }
?>
