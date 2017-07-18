<?php 
  session_start(); 

  require 'model/autoloader.php';

  /*
    Variable utilisée pour le chargement des assets, les redirections...
    Port 8888 utilisé en local
   */
  $root =  "//" . $_SERVER['SERVER_NAME'] . ":8888";
  //$root =  "//" . $_SERVER['SERVER_NAME'];

  $user = new User();
  $type = new Type();
  $category = new Category();
  $works = new Work();
  $salons = new Salons();
  $pages = new Page();

  //envoi de la notification de lecture d'un message avant le chargement de la page
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
  //si l'utilisateur est loggé
  if(isset($_SESSION['loggedin']) && !isset($curr_user)){
    //définition d'une variable globale de ses infos
    $curr_user = $user->get($_SESSION['userID']);
    //variable globale de ses messages
    $unreads = $user->getUnread("private_messages", $curr_user['id']);
    if(intval($curr_user['isAdmin']) > 0){
      //si user est admin, variable globale des messages admin
      $unreadsAdmin =  $user->getUnread("admin_messages", $curr_user['id']);
    }
  }
  
  //gestion du layout
  if(
    isset($_GET['p']) &&
    isset($_GET['action']) &&
    $_GET['p'] === 'processes'
  ){
    //si l'url demandée est un process/une action (comme "delete_user")
    //pas besoin de charger le layout, le code est directement éxécuté
    include 'view/layout/processes/'.$_GET['action'].'.php';
  }else if(isset($_GET['p']) && $_GET['p'] === "chatbox"){
    //dans l'iframe de chat, pas besoin du layout, 
    //juste des en-têtes et du chat
    include 'view/layout/includes/header.php';
    include 'view/layout/includes/chatbox.php';
  }else{
    //layout de toutes les autres pages
    include 'view/layout/includes/header.php';
    include 'view/layout/includes/nav.php';

    //s'il y a un message d'erreur/de succès, l'inclure
    if(isset($_SESSION['feedback'])){
      include 'view/layout/includes/feedback/'. $_SESSION['feedback'] .'.php';
      unset($_SESSION['feedback']);
    }

    if(isset($_GET['p']) && !empty($_GET['p'])){
      //on récupère le nom de la page
      //si elle contient un slash de fin, on le supprime
      $page = strstr($_GET['p'], '/') ? rtrim($_GET['p'], '/') : $_GET['p'];

      $discover_type = isset($_GET["type"]) && !empty($_GET["type"]) ? $_GET["type"] : null;
      $discover_cat = isset($_GET["category"]) && !empty($_GET["category"]) ? $_GET["category"] : null;
      $setid = isset($_GET["id"]) && !empty($_GET["id"]) ? $_GET["id"] : null;
      
      
      if(isset($_GET["cat"]) && $_GET["cat"] === "admin"){
        $pre = 'view/layout/admin/';
      }else{
        $pre = 'view/layout/';
      }

      echo '<div class="global">';

      if(file_exists($pre . $page . '/index.php')){
        include $pre . $page . '/index.php';
      }else{
        include 'view/layout/404/index.php';
      }

      echo '</div>';
    }else{
      echo '<div class="global">';
        include 'view/layout/home/index.php';
      echo '</div>';

    }
    include 'view/layout/includes/footer.php';

  }

?>