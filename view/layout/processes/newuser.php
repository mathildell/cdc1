<?php
  $email = htmlspecialchars(trim($_POST["email"]));
  if(isset($email) && !empty($email)){
    $user->registerEmail($email);
    $_SESSION['feedback'] = "newuser";
  }
?>
<script>window.location.replace("<?= $root; ?>/home");</script>