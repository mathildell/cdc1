<?php
if($curr_user['isAdmin'] == 1){
    $name = isset($_POST["name"]) ? htmlspecialchars(trim($_POST["name"])) : '';
    $data = [
      ':name' => $name
    ];
    
    $update = $type->save($data);
    
    if($update){
      $_SESSION['feedback'] = 'edittype_success';
      echo '<script>window.location.replace("'.$root.'/admin/types");</script>';
    }else{
      $_SESSION['feedback'] = 'edittype_failure';
      echo '<script>window.location.replace("'.$root.'/admin/types/new");</script>';
    }
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}