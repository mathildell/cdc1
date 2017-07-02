<?php
if($curr_user['isAdmin'] == 1){
    $name = isset($_POST["name"]) ? htmlspecialchars(trim($_POST["name"])) : '';

    $data = [
      ':name' => $name
    ];
    
    $update = $category->save($data);
    
    if($update){
      $_SESSION['feedback'] = 'newcat_success';
      echo '<script>window.location.replace("'.$root.'/admin/categories");</script>';
    }else{
      $_SESSION['feedback'] = 'newcat_failure';
      echo '<script>window.location.replace("'.$root.'/admin/categories/new");</script>';
    }
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}