<?php
if($curr_user['isAdmin'] == 1){
    $name = isset($_POST["name"]) ? htmlspecialchars(trim($_POST["name"])) : '';
    $id = isset($_POST["type_id"]) ? htmlspecialchars(trim($_POST["type_id"])) : '';
    $data = [
      ':name' => $name,
      ':id' => $id
    ];
    
    $update = $type->edit($data);
    
    if($update){
      $_SESSION['feedback'] = 'edittype_success';
      echo '<script>window.location.replace("'.$root.'/admin/types");</script>';
    }else{
      $_SESSION['feedback'] = 'edittype_failure';
      echo '<script>window.location.replace("'.$root.'/admin/types/'.$id.'/edit");</script>';
    }
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}