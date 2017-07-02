<?php
if($_SESSION['loggedin']){
  $work_id = isset($_POST['work_id']) ? intval(trim($_POST['work_id'])) : null;
  $salon_id = isset($_POST['salon_id']) ? intval(trim($_POST['salon_id'])) : null;
  $user_id = isset($_POST['user_id']) ? intval(trim($_POST['user_id'])) : null;
  $grade = isset($_POST['grade_book']) ? intval(trim($_POST['grade_book'])) : null;

  if(
      !empty($work_id) &&
      !empty($salon_id) &&
      !empty($user_id) &&
      !empty($grade)
    ){
    $data = [
      ':work_id' => $work_id,
      ':user_id' => $user_id,
      ':salon_id' => $salon_id,
      ':grade' => $grade
    ];
    $save = $salons->registerGrade($data);
    if($save){
      $_SESSION['feedback'] = 'savegrade_success';
    }else{
      $_SESSION['feedback'] = 'savegrade_failure';
    }
  }else{
    $_SESSION['feedback'] = 'savegrade_failure';
  }
}else{
  $_SESSION['feedback'] = 'notallowed';
}
echo '<script>window.location.replace("'.$root.'/salons/'.$salon_id.'");</script>'
?>