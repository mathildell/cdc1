<?php
  if($curr_user['isAdmin'] == 1){
    $id = isset($_POST['work_id']) ? htmlspecialchars(trim($_POST["work_id"])) : '';
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST["name"])) : '';
    $author = isset($_POST['author']) ? htmlspecialchars(trim($_POST["author"])) : '';
    $type_id = isset($_POST['type_id']) ? intval($_POST["type_id"]) : '';
    $cat_id = isset($_POST["cat_id"]) ? intval($_POST["cat_id"]) : '';
    $spotlight = isset($_POST["spotlight"]) ? intval($_POST["spotlight"]) : '';
    $description = isset($_POST["description"]) ? nl2br(htmlspecialchars(trim($_POST["description"]))) : '';
    $amazon = isset($_POST["url_amazon"]) ? htmlspecialchars(trim($_POST["url_amazon"])) : '';
    $datePublish = isset($_POST["datePublish"]) ? htmlspecialchars(trim($_POST["datePublish"])) : '';

    if($_FILES['img_src']['size'] > 0){
      $file = $_FILES['img_src'];
      $imageFileType = pathinfo(basename($file["name"]),PATHINFO_EXTENSION);
      if($file["size"] > 500000 && ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") ){
          $_SESSION['feedback'] = 'workupdate_failure';
          echo '<script>window.location.replace("'.$root.'/admin/works/'.$id.'/edit");</script>';
      }else{
        $uniqid = uniqid();
        $path = '/view/assets/img/works/' .$type_id.'_'.$cat_id.'_'.$uniqid.'.'.$imageFileType;
        $target_file = $_SERVER['DOCUMENT_ROOT'] . $path;
        $uploadOk = move_uploaded_file($file["tmp_name"], $target_file);
      }
    }else{
      $uploadOk = true;
    }
    if($uploadOk){

      $data = [
        ':type_id' => $type_id,
        ':category_id' => $cat_id,
        ':name' => $name,
        ':author' => $author,
        ':description' => $description,
        ':url_amazon' => $amazon,
        ':spotlight' => $spotlight,
        ':published_date' => $datePublish
      ];

      if($_FILES['img_src']['size'] > 0){
        $data[':img_src'] = $path;
      }

      if(isset($id)){
        $data[':id'] = $id;
      }



      $update = $works->update($data);
      if($update){
        $_SESSION['feedback'] = 'workupdate_success';
        echo '<script>window.location.replace("'.$root.'/admin/works");</script>';
        
      }else{
        $_SESSION['feedback'] = 'workupdate_failure';
        echo '<script>window.location.replace("'.$root.'/admin/works/'.$id.'/edit");</script>';
      }
    }else{
      $_SESSION['feedback'] = 'workupdate_failure';
      echo '<script>window.location.replace("'.$root.'/admin/works/'.$id.'/edit");</script>';
    }

  }else{
    $_SESSION['feedback'] = 'notallowed';
    echo '<script>window.location.replace("'.$root.'/home");</script>';
  }
?>