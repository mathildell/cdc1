<?php
if($curr_user['isAdmin'] == 1){
  $date = isset($_POST["date"]) ? htmlspecialchars(trim($_POST["date"])) : '';
  $hour = isset($_POST["hour"]) ? htmlspecialchars(trim($_POST["hour"])) : '';
  $datetime =  $date." ".$hour.":00.000000";

  $nbr_person_max = isset($_POST["nbr_person_max"]) ? htmlspecialchars(trim($_POST["nbr_person_max"])) : '';
  $work_id = isset($_POST["book"]) ? intval($_POST["book"]) : '';
  $admin_user_id = isset($_POST["admin_user_id"]) ? intval($_POST["admin_user_id"]) : '';


  if(
    $work_id > 0 &&
    $admin_user_id > 0 &&
    !empty($datetime) &&
    !empty($nbr_person_max)
  ){
    $data = [
      ':work_id' => $work_id,
      ':admin_salon_id' => $admin_user_id,
      ':date' => $datetime,
      ':nbr_person_max' => $nbr_person_max,
      ':work_isdeleted' => 0
    ];


    $update = $salons->save($data);
    
    if($update){
      $_SESSION['feedback'] = 'newsalon_success';
      echo '<script>window.location.replace("'.$root.'/admin/salons");</script>';
    }else{
      $_SESSION['feedback'] = 'newsalon_failure';
      echo '<script>window.location.replace("'.$root.'/admin/salons/new");</script>';
    }

  }else{
    $_SESSION['feedback'] = 'newsalon_failure';
    echo '<script>window.location.replace("'.$root.'/admin/salons/new");</script>';

  }

  var_dump($data); die();
  //
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}
?>