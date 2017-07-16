<?php
if(isset($_POST["email"])){
  $email = htmlspecialchars(trim($_POST["email"]));
  if(isset($email) && !empty($email)){
    $pwd = uniqid();

    $msg = "Vous pouvez vous connectez grâce à ces identifiants:\nEmail: ".$email."\nMot de passe provisoire: ".$pwd;
    $msg = wordwrap($msg,70);
    $subject = "Bienvenue sur le Club des Critiques";
    $headers = "From: mathildelucelucas@gmail.com";

    mail($email,$subject,$msg,$headers);

    $user->registerEmail($pwd, $email);
    $_SESSION['pwd_temp'] = $pwd;
    $_SESSION['feedback'] = "newuser";
  }
?>
<script>window.location.replace("<?= $root; ?>/home");</script>
<?php }else{
  $_SESSION['feedback'] = 'notallowed';
?>
<script>window.location.replace("<?= $root; ?>/home");</script>
<?php
}
?>