<?php
  if($_POST["userid"] === $curr_user['id'] ||  $curr_user['isAdmin'] == 1){
    $username = htmlspecialchars(trim($_POST["username"]));
    $email = htmlspecialchars(trim($_POST["nike-email"]));
    $isAdmin = isset($_POST["isAdmin"]) ? intval($_POST["isAdmin"]) : "no";
    $pwd = htmlspecialchars(trim($_POST["password"]));
    $pwdConfirm = htmlspecialchars(trim($_POST["password_confirm"]));
    $description = htmlspecialchars(trim($_POST["description"]));
    if($pwd === $pwdConfirm){
      $update = $user->saveUser($username, $email, $pwd, $description, $isAdmin, $_POST["userid"]);
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
    $_SESSION['feedback'] = 'notallowed';
?>
<script>window.location.replace("<?= $root; ?>/home");</script>
<?php
  }
?>