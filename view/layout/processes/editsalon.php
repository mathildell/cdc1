<?php
if($curr_user['isAdmin'] == 1 || $curr_user['id'] == $_POST['admin_user_id']){

  $id = isset($_POST["id"]) ? intval($_POST["id"]) : '';
  $date = isset($_POST["date"]) ? htmlspecialchars(trim($_POST["date"])) : '';
  $hour = isset($_POST["hour"]) ? htmlspecialchars(trim($_POST["hour"])) : '';
  $datetime =  $date." ".$hour.":00.000000";
  $nbr_person_max = isset($_POST["nbr_person_max"]) ? htmlspecialchars(trim($_POST["nbr_person_max"])) : '';
  $work_id = isset($_POST["book"]) ? intval($_POST["book"]) : '';
  $admin_salon_id = isset($_POST["admin_user_id"]) ? intval($_POST["admin_user_id"]) : '';
  $salon_open = isset($_POST["salon_open"]) ? intval($_POST["salon_open"]) : 0;

  $grade_users = isset($_POST['grade_users']) ? 1 : 0;


  if(
    $work_id > 0 &&
    !empty($datetime) &&
    $nbr_person_max > 0 &&
    ($salon_open === 0 || $salon_open === 1) &&
    $admin_salon_id > 0 &&
    $id > 0
  ){
    $data = [
      ':work_id' => $work_id,
      ':date' => $datetime,
      ':nbr_person_max' => $nbr_person_max,
      ':admin_salon_id' => $admin_salon_id,
      ':running' => $salon_open,
      ':id' => $id
    ];

    //$update = true;
    $update = $salons->update($data);
    
    if($update){
      if($grade_users > 0 && $salon_open != 1 && intval($_POST['hasAlreadyGraded']) === 0){
        for($i = 0; $i < intval($_POST['nbr_participants']); $i++){
          $dayum = [
            'grade' => $_POST['grade_book_'.$i],
            'user_id' => $_POST['user_id_grade_book_'.$i],
            'salon_id' => $id
          ];
          $salons->gradeUsers($dayum);
        }
      }

      $_SESSION['feedback'] = 'updatesalon_success';
      if($curr_user['isAdmin'] == 1){
        echo '<script>window.location.replace("'.$root.'/admin/salons");</script>';
      }else{
        echo '<script>window.location.replace("'.$root.'/salons/'.$id.'");</script>';
      }
      
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