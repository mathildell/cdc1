<?php
if(isset($curr_user) && intval($curr_user['isAdmin']) > 0){
  if(isset($_POST)){

    include 'simple_html_dom.php';

    $url = $_POST['url'];

    $html = file_get_html($url);
    $img = (!empty($html->find('img.frontImage'))) ? $html->find('img.frontImage')[0]->src : "";

    $title = (!empty($html->find('#title > span'))) ? $html->find('#title > span')[0]->plaintext : ""; 

    $author = (!empty($html->find('#byline > .author .a-link-normal'))) ? $html->find('#byline > .author .a-link-normal')[0]->plaintext : ""; 
    
    if(strpos($author, 'Consulter la page') !== false){
      $author = str_replace(array("Consulter la page ", " d'Amazon"), "", $author);
    }


    $data = [
      "src" => urldecode(trim($img)),
      "titre" => trim($title),
      "author" => trim($author),
      "description" => ""
    ];


    echo json_encode($data);

  }
}