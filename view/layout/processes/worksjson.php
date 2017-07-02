<?php
  $allWorks = $works->getOrdered();
  $data = [];
  foreach($allWorks as $key => $book){
    $typename = $type->getOne($book['type_id'])['name'];
    $set = [
      "label" => trim($book['name']),
      "category" => trim($typename),
      "id" => trim($book['id'])
    ];
    array_push($data, $set);
  }
  echo json_encode($data);
?>