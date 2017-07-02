<?php
if($curr_user['isAdmin'] == 1){
    $name = isset($_POST["name"]) ? htmlspecialchars(trim($_POST["name"])) : '';
    $content = isset($_POST["content"]) ? htmlspecialchars(trim($_POST["content"])) : '';
    $is_footer_link = 1;
    
    if(!empty($content) && !empty($name)){
      $data = [
        ':name' => $name,
        ':content' => $content,
        ':is_footer_link' => $is_footer_link
      ];
    
      $update = $pages->save($data);
      
      if($update){
        $_SESSION['feedback'] = 'pagecreated_success';
        echo '<script>window.location.replace("'.$root.'/admin/pages");</script>';
      }else{
        $_SESSION['feedback'] = 'pagecreated_failure';
        echo '<script>window.location.replace("'.$root.'/admin/pages/'.$id.'/edit");</script>';
      }
    }else{
      $_SESSION['feedback'] = 'pagecreated_failure';
      echo '<script>window.location.replace("'.$root.'/admin/pages/'.$id.'/edit");</script>';
    }
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}