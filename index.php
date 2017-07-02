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
  $pages = new Page();
  if(
    isset($_SESSION['loggedin'])
    && isset($_GET['p'])
    && ( isset($_GET['msg_id'])  || $_GET['p'] === 'messages' )
  ){
    if(
      $_GET['p'] === 'user' 
      && isset($_GET['messages'])
      && isset($_GET['msg_id'])
    ){
      $isUnread = $user->messageUnread("private_messages", $_GET['msg_id']);
      if(intval($isUnread['unread']) === 1){
        $user->sendReadNotif("private_messages", $_GET['msg_id']);
      }
    }else if(
      $_GET['p'] === 'messages' 
      && isset($_GET['cat'])
      && $_GET['cat'] === 'admin' 
      && isset($_GET['id'])
    ){
      $isUnread = $user->messageUnread("admin_messages", $_GET['id']);
      if(intval($isUnread['unread']) === 1){
        $user->sendReadNotif("admin_messages", $_GET['id']);
      }
    }

  }
  
  if(isset($_SESSION['loggedin']) && !isset($curr_user)){
    $curr_user = $user->get($_SESSION['userID']);
    $unreads = $user->getUnread("private_messages", $curr_user['id']);
    if(intval($curr_user['isAdmin']) > 0){
      $unreadsAdmin =  $user->getUnread("admin_messages", $curr_user['id']);
    }
  }
  
  if(
    isset($_GET['p']) &&
    isset($_GET['action']) &&
    $_GET['p'] === 'processes'
  ){
    include 'view/layout/processes/'.$_GET['action'].'.php';
  }else if(isset($_GET['p']) && $_GET['p'] === "chatbox"){
    include 'view/layout/includes/header.php';
    include 'view/layout/includes/chatbox.php';
  }else{
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

  }

?>