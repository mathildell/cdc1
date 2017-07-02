<?php
  $chatbox = $salons->getAllChatMessagesTime();
  $data = [];
  foreach($chatbox as $key => $timestamp){

    $day = date('l', strtotime($timestamp['timestamp']));
    $hour = date('G', strtotime($timestamp['timestamp']));
    //if($hour)
    if(isset($data[$day][$hour])){
      $data[$day][$hour]++;
    }else{
      //['Hour', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
      $data[$day][$hour] = 1;
    }
    //$set = [$hour, $day];
    //if()
    

    //array_push($data, $set);
  }
  echo json_encode($data);
?>