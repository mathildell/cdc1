<?php
  if($curr_user['isAdmin'] == 1){
    $username = htmlspecialchars(trim($_POST["username"]));
    $email = htmlspecialchars(trim($_POST["nike-email"]));
    $isAdmin = isset($_POST["isAdmin"]) ? intval($_POST["isAdmin"]) : "no";
    $pwd = htmlspecialchars(trim($_POST["password"]));
    $pwdConfirm = htmlspecialchars(trim($_POST["password_confirm"]));
    $description = htmlspecialchars(trim($_POST["description"]));
    if($pwd === $pwdConfirm){
      $file = $_FILES['profile_picture'];
      $imageFileType = pathinfo(basename($file["name"]),PATHINFO_EXTENSION);
      if($file["size"] > 500000 && ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") ){
        $_SESSION['feedback'] = 'profile_failure';
        echo '<script>window.location.replace("'.$root.'/user/'.$_POST["userid"].'/edit");</script>';
      }else{
        $uniqid = uniqid();
        $path = '/view/assets/img/user_upload/' .$username.'_'.$uniqid.'.'.$imageFileType;
        $target_file = $_SERVER['DOCUMENT_ROOT'] . $path;
        $uploadOk = move_uploaded_file($file["tmp_name"], $target_file);
      }
      if($uploadOk){
        $data = [
          ':username' => $username,
          ':email' => $email,
          ':password' => $pwd,
          ':description' => $description,
          ':picture' => $path,
          ':isAdmin' => $isAdmin
        ];
        $update = $user->newAdminUser($data);
        if($update){
          $_SESSION['feedback'] = 'profile_success';
        
          if($curr_user['isAdmin'] == 1){
            echo '<script>window.location.replace("'.$root.'/admin/users");</script>';
          }else{
            echo '<script>window.location.replace("'.$root.'/user/'.$_POST["userid"].'");</script>';
          }
        }else{
          $_SESSION['feedback'] = 'profile_failure';
          echo '<script>window.location.replace("'.$root.'/user/'.$_POST["userid"].'/edit");</script>';
        }
      }else{
        $_SESSION['feedback'] = 'profile_failure';
        echo '<script>window.location.replace("'.$root.'/user/'.$_POST["userid"].'/edit");</script>';
      }
    }else{
        $_SESSION['feedback'] = 'profile_failure';
        echo '<script>window.location.replace("'.$root.'/user/'.$_POST["userid"].'/edit");</script>';
      }

  }else{
    $_SESSION['feedback'] = 'notallowed';
?>
<script>window.location.replace("<?= $root; ?>/home");</script>
<?php
  }
?>