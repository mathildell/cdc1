<?php
  if($curr_user['isAdmin'] == 1){
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST["name"])) : '';
    $author = isset($_POST['author']) ? htmlspecialchars(trim($_POST["author"])) : '';
    $type_id = isset($_POST['type_id']) ? intval($_POST["type_id"]) : '';
    $cat_id = isset($_POST["cat_id"]) ? intval($_POST["cat_id"]) : '';
    $img_src_amazon = isset($_POST["img_src_amazon"]) ? urldecode($_POST['img_src_amazon']) : '';
    $spotlight = isset($_POST["spotlight"]) ? intval($_POST["spotlight"]) : '';
    $description = isset($_POST["description"]) ? nl2br(htmlspecialchars(trim($_POST["description"]))) : '';
    $amazon = isset($_POST["url_amazon"]) ? htmlspecialchars(trim($_POST["url_amazon"])) : '';
    $datePublish = isset($_POST["datePublish"]) ? htmlspecialchars(trim($_POST["datePublish"])) : '';

    $file = $_FILES['img_src'];
    $imageFileType = pathinfo(basename($file["name"]),PATHINFO_EXTENSION);

    $uniqid = uniqid();
    $path = '/view/assets/img/works/' .$type_id.'_'.$cat_id.'_'.$uniqid.'.'.$imageFileType;
    $target_file = $_SERVER['DOCUMENT_ROOT'] . $path;

    if(!empty($img_src_amazon)){
      file_put_contents($target_file, file_get_contents($img_src_amazon));
      $uploadOk = true;
    }else{
      if($file["size"] > 500000 && ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") ){
        $_SESSION['feedback'] = 'work_failure';
        echo '<script>window.location.replace("'.$root.'/admin/works/new");</script>';
      }else{
        $uploadOk = move_uploaded_file($file["tmp_name"], $target_file);
      }
    }
    if($uploadOk){
      $data = [
        ':type_id' => $type_id,
        ':category_id' => $cat_id,
        ':name' => $name,
        ':author' => $author,
        ':img_src' => $path,
        ':description' => $description,
        ':url_amazon' => $amazon,
        ':spotlight' => $spotlight,
        ':published_date' => $datePublish
      ];
      $update = $works->new($data);
      if($update){
        $_SESSION['feedback'] = 'work_success';
        echo '<script>window.location.replace("'.$root.'/admin/works");</script>';
        
      }else{
        $_SESSION['feedback'] = 'work_failure';
        echo '<script>window.location.replace("'.$root.'/admin/works/new");</script>';
      }
    }else{
      $_SESSION['feedback'] = 'work_failure';
      echo '<script>window.location.replace("'.$root.'/admin/works/new");</script>';
    }

  }else{
    $_SESSION['feedback'] = 'notallowed';
    echo '<script>window.location.replace("'.$root.'/home");</script>';
  }
?>