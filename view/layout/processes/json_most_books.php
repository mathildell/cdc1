<?php
  $exchanges = $user->getAllExchanges();
  
  $data = [];
  foreach($exchanges as $key => $exchange){
    $uid = $exchange['user_id'];
    $g = $user->get($uid)['username'];
    if($exchange['status'] != 2){

      //$status = $user->getExStatus($exchange['status']);
      $status = $exchange['status'];

      if(isset($data[$uid])){

        if(isset($data[$uid][$status])){

          $data[$uid][$status]++;
        }else{
          $data[$uid][$status] = 1;
        }

      }else{
        $data[$uid]['name'] = $g;
        $data[$uid][$status] = 1;
      }

    }
    //*/
  }
  usort($data, function($a, $b){
    if(isset($a[0]) && isset($a[1])){
      $val1 = ($a[0] + $a[1]);
    }else if( isset($a[0]) && !isset($a[1]) ){
      $val1 = $a[0];
    }else if( !isset($a[0]) && isset($a[1]) ){
      $val1 = $a[1];
    }

    if(isset($b[0]) && isset($b[1])){
      $val2 = ($b[0] + $b[1]);
    }else if( isset($b[0]) && !isset($b[1]) ){
      $val2 = $b[0];
    }else if( !isset($b[0]) && isset($b[1]) ){
      $val2 = $b[1];
    }

    return $val1 < $val2;
  });
  
  $data = array_slice($data, 0, 5);

  echo json_encode($data);
?>