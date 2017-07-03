<?php
  $users = $user->getAll();
  $data = [];
  foreach($users as $key => $user){
    $set = [
      "label" => ucfirst(trim($user['username'])),
      "id" => trim($user['id'])
    ];
    array_push($data, $set);
  }
  echo json_encode($data);
?>