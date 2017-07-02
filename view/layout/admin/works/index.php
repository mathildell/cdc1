<?php
  include 'view/layout/includes/breadcrumbs.php';
  $editMode = (isset($_GET['edit'])) ? true : false;
  $newMode = (isset($_GET['new'])) ? true : false;
  $editId = (isset($_GET['id'])) ? $_GET['id'] : false;
  if($editMode){
    $book = $works->getOne($editId);
    $discover_type = $works->getBookType($book['id']);
    $discover_cat = $works->getBookCat($book['id']);
    include 'edit.php';
  }else if($newMode){
    include 'new.php';
  }else{
    $theBooks = $works->getAllWhere([':is_deleted' => 0]);
    $countBooks = count($theBooks);
    include 'list.php';
  }
?>
