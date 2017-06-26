<?php 
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  session_start(); 

  require 'model/autoloader.php';
  
  $root =  "http://" . $_SERVER['SERVER_NAME'] . ":8888";

  $user = new User();
  $type = new Type();
  $category = new Category();
  $works = new Work();
  $salons = new Salons();
  if(isset($_SESSION['loggedin']) && !isset($curr_user)){
    $curr_user = $user->get($_SESSION['userID']);
  }
  
  include 'view/layout/includes/header.php';
  include 'view/layout/includes/nav.php';

  if(isset($_SESSION['feedback'])){
    include 'view/layout/includes/feedback/'. $_SESSION['feedback'] .'.php';
    unset($_SESSION['feedback']);
  }

  if(isset($_GET['p'])){

    $page = strstr($_GET['p'], '/') ? rtrim($_GET['p'], '/') : $_GET['p'];

    $discover_type = isset($_GET["type"]) && !empty($_GET["type"]) ? $_GET["type"] : null;
    $discover_cat = isset($_GET["category"]) && !empty($_GET["category"]) ? $_GET["category"] : null;
    $setid = isset($_GET["id"]) && !empty($_GET["id"]) ? $_GET["id"] : null;
    
    //$breadcrumbs = [$page, $_GET];

    if(isset($_GET["cat"]) && $_GET["cat"] === "admin"){
      $pre = 'view/layout/admin/';
    }else{
      $pre = 'view/layout/';
    }

    echo '<div class="global">';

    //var_dump($discover, $_GET["p"], $_GET["category"], $_GET["id"]);
    if(file_exists($pre . $page . '/index.php')){
      include $pre . $page . '/index.php';
    }else{
      include 'view/layout/404/index.php';
    }

    echo '</div>';
  }else{

    include $pre . 'home/index.php';

  }
  include 'view/layout/includes/footer.php';

?>