<?php
spl_autoload_register(function ($class) {
  if(file_exists( $_SERVER['DOCUMENT_ROOT'] . '/controller/facebook/' . $class . '.php')){
      return require( $_SERVER['DOCUMENT_ROOT'] . '/controller/facebook/' . $class . '.php'); 
  }else if(file_exists( $_SERVER['DOCUMENT_ROOT'] . '/model/facebook/' . $class . '.php')){
      return require( $_SERVER['DOCUMENT_ROOT'] . '/model/facebook/' . $class . '.php'); 
  }else if(file_exists( $_SERVER['DOCUMENT_ROOT'] . '/controller/' . $class . '.php')){
      return require( $_SERVER['DOCUMENT_ROOT'] . '/controller/' . $class . '.php'); 
  }else if(file_exists( $_SERVER['DOCUMENT_ROOT'] . '/model/' . $class . '.php')){
      return require( $_SERVER['DOCUMENT_ROOT'] . '/model/' . $class . '.php'); 
  }else if(file_exists( $_SERVER['DOCUMENT_ROOT'] . '/config/' . $class . '.php')){
      return require( $_SERVER['DOCUMENT_ROOT'] . '/config/' . $class . '.php'); 
  }
});