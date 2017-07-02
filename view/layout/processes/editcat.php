<?php
if($curr_user['isAdmin'] == 1){
    $name = isset($_POST["name"]) ? htmlspecialchars(trim($_POST["name"])) : '';
    $id = isset($_POST["cat_id"]) ? htmlspecialchars(trim($_POST["cat_id"])) : '';
    $data = [
      ':name' => $name,
      ':id' => $id
    ];
    
    $update = $category->edit($data);
    
    if($update){
      $_SESSION['feedback'] = 'editcat_success';
      echo '<script>window.location.replace("'.$root.'/admin/categories");</script>';
    }else{
      $_SESSION['feedback'] = 'editcat_failure';
      echo '<script>window.location.replace("'.$root.'/admin/categories/'.$id.'/edit");</script>';
    }
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}