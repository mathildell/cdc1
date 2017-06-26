<?php
  include 'view/layout/includes/breadcrumbs.php';
  $editMode = (isset($_GET['edit'])) ? true : false;
  $editId = (isset($_GET['id'])) ? $_GET['id'] : false;
  if($editMode){
    $book = $works->getOne($editId);
    $discover_type = $works->getBookType($book['id']);
    $discover_cat = $works->getBookCat($book['id']);
    include 'edit.php';
  }else{
    $theBooks = $works->getAll();
    $countBooks = count($theBooks);
    include 'list.php';
  }
?>
