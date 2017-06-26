<?php
  if(file_exists(__DIR__ . '/' .$_GET['action'].'.php')){
    include __DIR__ . '/' .$_GET['action'].'.php';
  }
?>