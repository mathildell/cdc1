<?php
  $grades = $salons->getAllGrades();

  $data = [];
  foreach($grades as $key => $grade){
    $g = $grade['grade'];
    if(isset($data[$g])){
      $data[$g]++;
    }else{
      $data[$g] = 1;
    }
  }
  echo json_encode($data);
?>