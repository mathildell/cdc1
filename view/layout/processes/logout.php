<?php
  //unset($_SESSION);
  unset($curr_user);
  session_unset ( );
  echo '<script> window.location.replace("'.$root.'/login");</script>';
?>
<!---->