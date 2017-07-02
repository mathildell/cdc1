<?php
if($curr_user['isAdmin'] == 1){
    $name = isset($_POST["name"]) ? htmlspecialchars(trim($_POST["name"])) : '';
    $content = isset($_POST["content"]) ? htmlspecialchars(trim($_POST["content"])) : '';
    //$is_footer_link = isset($_POST["is_footer_link"]) ? intval(trim($_POST["is_footer_link"])) : '';
    $id = isset($_POST["id"]) ? intval(trim($_POST["id"])) : '';

    if(!empty($content) && !empty($name) && $id > 0){
      $data = [
        ':name' => $name,
        ':content' => $content,
        //':is_footer_link' => $is_footer_link,
        ':id' => $id
      ];
    
      $update = $pages->edit($data);
      
      if($update){
        $_SESSION['feedback'] = 'editpage_success';
        echo '<script>window.location.replace("'.$root.'/admin/pages");</script>';
      }else{
        $_SESSION['feedback'] = 'editpage_failure';
        echo '<script>window.location.replace("'.$root.'/admin/pages/'.$id.'/edit");</script>';
      }
    }else{
      $_SESSION['feedback'] = 'editpage_failure';
      echo '<script>window.location.replace("'.$root.'/admin/pages/'.$id.'/edit");</script>';
    }
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}