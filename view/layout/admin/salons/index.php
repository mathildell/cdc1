<?php
  include 'view/layout/includes/breadcrumbs.php';
  $editMode = (isset($_GET['edit'])) ? true : false;
  $newMode = (isset($_GET['new'])) ? true : false;
  $editId = (isset($_GET['id'])) ? $_GET['id'] : false;
  if($editMode){
    $salon = $salons->getOne($editId);

    $workAssoc = $salons->getWorkOfSalon($salon['work_id']);
    $bookType = $works->getBookType($workAssoc['id'])['name'];
    $bookGenre = $works->getBookCat($workAssoc['id'])['name'];

  
    include 'edit.php';
  }else if($newMode){
    include 'new.php';
  }else{
    $salonss = $salons->getAll();
    $countSalons = count($salonss);
    include 'list.php';
  }
?>
