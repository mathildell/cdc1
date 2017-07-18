<form class="form admin" method="post" action="<?= $root ?>/processes/editsalon">
<input type="hidden" value="<?= $salon['id']; ?>" name="id">
<?php
  //strtotime( $salon['date'] ) < time() === le salon était avant
  if(
    !(strtotime( $salon['date'] ) < time())
    || intval($salon['running']) === 1
  ){
?>
<div class="row">
  <div class="col-sm-6">
    <h2 class="small_title">Le chat et le salon</h2>
    Les utilisateurs ne peuvent interéagir sur le chat du salon que lorsque celui-ci est activé. S'il est inactif, le salon est visible pour que les gens s'y inscrivent/lisent ce qui y a été dit.
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="salon_open">Le salon est ouvert :</label>
      <select class="form-control" name="salon_open" id="salon_open">
        <option value="0"<?= (intval($salon['running']) === 0) ? ' selected' : ''?>>Non</option>
        <option value="1"<?= (intval($salon['running']) === 1) ? ' selected' : ''?>>Oui</option>
      </select>
    </div>
  </div>
</div>
<?php } 
$salonPast = (strtotime( $salon['date'] ) < time() && $salon['running'] != 1) ? true : false;
$isset = false;
?>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="date">Date:</label>
      <input class="form-control datepicker" type="text" name="date" value="<?= date( 'o-m-d', strtotime( $salon['date'] )) ?>"<?= ($salonPast) ? ' readonly' : ''; ?>>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="hour">Heure:</label>
      <input class="form-control" type="time" name="hour" value="<?= date( 'H:i', strtotime( $salon['date'] )) ?>"<?= ($salonPast) ? ' readonly' : ''; ?>>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="admin_user_id1">Administrateur du salon: </label>
      <input type="text" id="admin_user_id1" class="form-control autocomplete" value="<?= ucfirst($adminSalon['username']); ?>"<?= ($salon['admin_salon_id'] == $curr_user['id'] && $curr_user['isAdmin'] == 0) ? ' readonly' : ''; ?><?= ($salonPast) ? ' readonly' : ''; ?>>
      <input type="hidden" name="admin_user_id" id="admin_user_id" value="<?= $adminSalon['id']; ?>"<?= ($salon['admin_salon_id'] == $curr_user['id'] && $curr_user['isAdmin'] == 0) ? ' readonly' : ''; ?><?= ($salonPast) ? ' readonly' : ''; ?>>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="books">Oeuvre:</label>
      <input type="text" id="books" class="form-control autocomplete" value="<?= $workAssoc['name']; ?>"<?= ($salon['admin_salon_id'] == $curr_user['id'] && $curr_user['isAdmin'] == 0) ? ' readonly' : ''; ?><?= ($salonPast) ? ' readonly' : ''; ?>>
      <input type="hidden" name="book" id="book_id" value="<?= $workAssoc['id']; ?>"<?= ($salon['admin_salon_id'] == $curr_user['id'] && $curr_user['isAdmin'] == 0) ? ' readonly' : ''; ?><?= ($salonPast) ? ' readonly' : ''; ?>>
      <!--<i class="form-text text-muted"><small>Commencez à écrire pour des suggestions...</small></i>-->
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="nbr_person_max">Nombre de personnes max.:</label>
      <input class="form-control" type="number" name="nbr_person_max" value="20"<?= ($salonPast) ? ' readonly' : ''; ?>>
    </div>
  </div>
</div>
<?php
if( strtotime( $salon['date'] ) < time() || intval($salon['running']) === 1 ){

$grades  = $salons->getGrades($salon['id']);
$countg = count($grades);
if(intval($grades[0]['grade_user']) != 0 || intval($grades[1]['grade_user']) != 0){
  $hasAlreadyGraded = true;
}else{
  $hasAlreadyGraded = false;
}
?>
<br> <hr> <br>
<div class="row">
  <div class="col-sm-12">
    <h3 class="small_title">
      <input type="checkbox" name="grade_users" id="grade_users"<?= ($hasAlreadyGraded) ? ' checked disabled' : ''; ?>>
      <label for="grade_users">Évaluer les participants</label>
      <input type="hidden" name="hasAlreadyGraded" value="<?= ($hasAlreadyGraded) ? '1' : '0'; ?>">
    </h3>
    <p>
      <?= (!$hasAlreadyGraded) ? 'Cette section ne doit être remplie qu\'une seule fois, à la fin du salon.' : ''; ?>
    </p>
    <br>
  </div>
</div> 
<div class="row grade_users_row"<?= (!$hasAlreadyGraded) ? ' style="display:none;"' : ''; ?>>
  <div class="col-sm-12">
    <table class="table">
      <thead>
        <th>
          Nom
        </th>
        <th>
          Nombre de messages
        </th>
        <th style="width: 170px;">
          Note sur 4
        </th>
        <th style="width: 500px;">
          <i style="display: inline-block; width:40px; height:1px;"></i>Rappel des critères de notation
        </th>
      </thead>
      <tbody>
        <input type="hidden" value="<?= (intval($countg) - 1); ?>" name="nbr_participants">
      <?php
          $i = 0;
          foreach ($grades as $key => $grade) {
            if(
              $grade['user_id'] !== $salon['admin_salon_id'] 
            ){

              $nmbrmsg = count($salons->getParticip($grade['user_id'], $salon['id']));
          ?>
          <tr>
            <td class="userPrev"> 
              <img src="<?= $root . $grade['picture']; ?>">
              <a href="<?= $root; ?>/user/<?= $grade['user_id']; ?>"><?= $grade['username']; ?></a>
            </td>
            <td>
              <?= ($nmbrmsg > 1) ? $nmbrmsg.' messages' : $nmbrmsg.' message'; ?>
            </td>
            <td class="grade">  
              <input type="hidden" name="user_id_grade_book_<?= $i; ?>" value="<?= $grade['user_id']; ?>">
              <div class="form-group" data-grade="1">
                <label for="grade_book_1_<?= $i; ?>"></label>
                <input type="radio" id="grade_book_1_<?= $i; ?>" name="grade_book_<?= $i; ?>" value="1"<?php if($hasAlreadyGraded){ echo ($grade['grade_user'] == 1) ? ' checked disabled' : ' disabled'; } ?>>
              </div>
              <div class="form-group" data-grade="2">
                <label for="grade_book_2_<?= $i; ?>"></label>
                <input type="radio" id="grade_book_2_<?= $i; ?>" name="grade_book_<?= $i; ?>" value="2"<?php if($hasAlreadyGraded){ echo ($grade['grade_user'] == 2) ? ' checked disabled' : ' disabled'; } ?>>
              </div>
              <div class="form-group" data-grade="3">
                <label for="grade_book_3_<?= $i; ?>"></label>
                <input type="radio" id="grade_book_3_<?= $i; ?>" name="grade_book_<?= $i; ?>" value="3"<?php if($hasAlreadyGraded){ echo ($grade['grade_user'] == 3) ? ' checked disabled' : ' disabled'; } ?>>
              </div>
              <div class="form-group" data-grade="4">
                <label for="grade_book_4_<?= $i; ?>"></label>
                <input type="radio" id="grade_book_4_<?= $i; ?>" name="grade_book_<?= $i; ?>" value="4"<?php if($hasAlreadyGraded){ echo ($grade['grade_user'] == 4) ? ' checked disabled' : ' disabled'; } ?>>
              </div>
            </td>
          <?php
              if(
                $isset == false
              ){
                $isset = true;
              ?>
                <td rowspan="<?= $countg; ?>" style="vertical-align: middle; border:1px solid #ddd;background-color: #fafafa;">
                  <div style="margin: 20px 50px;">
                    <ul style="list-style-type: disc;">
                      <li>
                        <b>Participation</b>
                        <ul style="list-style-type: circle; padding-left: 30px;">
                          <li>Quantité de la prise de parole</li>
                          <li>Qualité de la prise de parole</li>
                          <li>Orthographe &amp; expréssion</li>
                        </ul>
                      </li>
                      <br>
                      <li>
                        <b>Comportement</b>
                        <ul style="list-style-type: circle; padding-left: 30px;">
                          <li>Politesse &amp; bienséance</li>
                        </ul>
                      </li>
                    </ul>
                    <br>
                    <p><i style="color: gray;">En aucun cas cette note ne doit se baser sur l'opinion personelle du participant.</i></p>
                  </div>
                </td>
              <?php
              }
              $i++;
            }
            ?>
          </tr>
          <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
<?php 
}else{
  $hasAlreadyGraded = false;
} ?>
<div class="row">
  <div class="col-sm-12 align-right">
    <?= ($salonPast && $hasAlreadyGraded) ? '<br>' : '<button type="submit" class="btn btn-primary">Modifier</button>'; ?>
  </div>
</div>
</form>

<script>
$(function(){

  $('#grade_users').change(function(){
    if($(this).is(':checked')){
      $('.grade_users_row').show();
    }else{
      $('.grade_users_row').hide();
    }
  });



});
</script>
<?php if(!$hasAlreadyGraded){ ?>
<script>
$(function(){
  var grade, isChecked = false;

  $('.grade .form-group[data-grade] input').change(function(){
    if($(this).is(':checked')){
      isChecked = $(this).parent().data('grade');
    }else{
      isChecked = false;
    }
  });

  $('.grade .form-group[data-grade]').hover(function(){
    grade = parseInt($(this).data('grade'));
    if(isChecked){
      $(this).parent().find('.form-group[data-grade]').removeClass('active')
    }
    for(var i = grade; i >= 0; i--){
      $(this).parent().find('.form-group[data-grade="'+i+'"]').addClass('active');
    }
  }, function(){
      if(!isChecked){ 
        $(this).parent().find('.form-group[data-grade]').removeClass('active');
      }else{
        for(var i = isChecked; i >= 0; i--){
          $(this).parent().find('.form-group[data-grade="'+i+'"]').addClass('active');
        }
      }
      
  });
});
</script>
<?php }else{ ?>
<script>
$(function(){
  var grade, isChecked = false;
  $('.form-group[data-grade]').each(function(){
    console.log($('input', this).is(':checked'));
    if($('input', this).is(':checked')){
      isChecked = $(this).data('grade');
      for(var i = isChecked; i >= 0; i--){
        $(this).parent().find('.form-group[data-grade="'+i+'"]').addClass('active');
      }
    }else{
      isChecked = false;
    }
  });
});
</script>
<?php } ?>
<script>
$(function(){

  $.ajax({
    url: '<?= $root; ?>/processes/worksjson',
    success: function(data){
      var json = JSON.parse(data);
      $('#books').catcomplete({
        delay: 0,
        source: json,
        select: function (event, ui) {
          $('#book_id').val(ui.item.id); 
        }
      });
    }
  });
  $.ajax({
    url: '<?= $root; ?>/processes/json_users',
    success: function(data){
      var json = JSON.parse(data);
      $('#admin_user_id1').autocomplete({
        source: json,
        select: function (event, ui) {
          $('#admin_user_id').val(ui.item.id); 
        }
      });
    }
  });
});
</script>