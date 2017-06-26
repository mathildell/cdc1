<?php
  include 'view/layout/includes/breadcrumbs.php';
  $editMode = (isset($_GET['edit'])) ? true : false;
  $editId = (isset($_GET['id'])) ? $_GET['id'] : false;
  if($editMode){
    $theCat = $category->getOne($editId);
    include 'edit.php';
  }else{
    $cats = $category->getAll();
    $countCats = count($cats);
    include 'list.php';
  }
?>
