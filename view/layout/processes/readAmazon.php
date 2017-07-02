<?php
if($curr_user['isAdmin'] > 0){
  if(isset($_POST)){
    $url = $_POST['url'];
    $html = file_get_contents($url);
    $doc = new DOMDocument();
    @$doc->loadHTML($html);

    $image = $doc->getElementById('imgBlkFront')->getAttribute('src');
    $titre = $doc->getElementById('productTitle')->textContent;
    $author = $doc->getElementById('byline')->getElementsByTagName('span')[0]->getElementsByTagName('span')[0]->childNodes[0]->textContent;

    $catType = $doc->getElementById('SalesRank')->getElementsByTagName('ul')[0]->getElementsByTagName('li')[0]->getElementsByTagName('a');
    $catTypeCount = ($catType->length) - 1;

    foreach ($catType as $key => $value) {
      if($key === 0){
        $type = $value->textContent;
        if(substr($type, -1) === 's'){
          $type = strtolower(rtrim($type, 's'));
        }
      }else if($key === $catTypeCount){
        $category = $value->textContent;
        if(substr($category, -1) === 's'){
          $category = strtolower(rtrim($category, 's'));
        }
      }
    }
    $data = [
      "src" => urldecode(trim($image)),
      "titre" => trim($titre),
      "author" => trim($author),
      "type" => trim($type),
      "category" => trim($category)

    ];

    echo json_encode($data);

  }
  
}