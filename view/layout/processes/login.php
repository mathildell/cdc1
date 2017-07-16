<?php
if(isset($_POST)){
    $email = htmlspecialchars(trim($_POST["email"]));
    $pwd = htmlspecialchars(trim($_POST["password"]));
    if(
        isset($email) && !empty($email) &&
        isset($pwd) && !empty($pwd)
    ){
      $con = $user->login($email, $pwd);
      if($con){
        $_SESSION['loggedin'] = true;
        $_SESSION['userID'] = $con['id'];
        echo '<script> window.location.replace("'.$root.'/user/'.$con['id'].'");</script>';
      }else{
        $_SESSION['feedback'] = "login_error";
        echo '<script> window.location.replace("'.$root.'/login");</script>';
      }
    }else{
      $_SESSION['feedback'] = "login_error";
      echo '<script> window.location.replace("'.$root.'/login");</script>';
    }
  }else{
  $_SESSION['feedback'] = 'notallowed';
?>
<script>window.location.replace("<?= $root; ?>/home");</script>
<?php
}
?>