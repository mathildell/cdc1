<?php
  $cats = $category->getAll();
  $works = $works->getAll();

  $data = [];
  foreach($works as $key => $work){
    $current_cat = $cats[$work['category_id']-1]['name'];
    if(isset($data[$current_cat])){
      $data[$current_cat]++;
    }else{
      $data[$current_cat] = 1;
    }
  }
  echo json_encode($data);
?>