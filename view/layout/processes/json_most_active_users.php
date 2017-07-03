<?php
  $grades = $salons->getAllGrades();

  //array_count_values($grades);
  $data = [];
  
  foreach($grades as $key => $grade){
    $uid = $grade['user_id'];
    $g = $user->get($uid)['username'];
    if(isset($data[$uid])){
      $data[$uid]['count']++;
    }else{
      $data[$uid]['name'] = $g;
      $data[$uid]['count'] = 1;
    }
  }

  usort($data, function($a, $b){
    return $a['count'] < $b['count'];
  });

  $data = array_slice($data, 0, 5);

  echo json_encode($data);
?>