<?php
if($curr_user['isAdmin'] == 1){
  $id = isset($_POST["id"]) ? intval($_POST["id"]) : '';
  $date = isset($_POST["date"]) ? htmlspecialchars(trim($_POST["date"])) : '';
  $hour = isset($_POST["hour"]) ? htmlspecialchars(trim($_POST["hour"])) : '';
  $datetime =  $date." ".$hour.":00.000000";
  $nbr_person_max = isset($_POST["nbr_person_max"]) ? htmlspecialchars(trim($_POST["nbr_person_max"])) : '';
  $work_id = isset($_POST["book"]) ? intval($_POST["book"]) : '';
  $salon_open = isset($_POST["salon_open"]) ? intval($_POST["salon_open"]) : 0;
  if(
    $work_id > 0 &&
    !empty($datetime) &&
    $nbr_person_max > 0 &&
    ($salon_open === 0 || $salon_open === 1) &&
    $id > 0
  ){
    $data = [
      ':work_id' => $work_id,
      ':date' => $datetime,
      ':nbr_person_max' => $nbr_person_max,
      ':running' => $salon_open,
      ':id' => $id
    ];


    $update = $salons->update($data);
    
    if($update){
      $_SESSION['feedback'] = 'updatesalon_success';
      echo '<script>window.location.replace("'.$root.'/admin/salons");</script>';
    }else{
      $_SESSION['feedback'] = 'updatesalon_failure';
      echo '<script>window.location.replace("'.$root.'/admin/salons/'.$id.'/edit");</script>';
    }

  }else{
    $_SESSION['feedback'] = 'updatesalon_failure';
    echo '<script>window.location.replace("'.$root.'/admin/salons/'.$id.'/edit");</script>';

  }
  //
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}
?>