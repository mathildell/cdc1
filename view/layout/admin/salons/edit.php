<form class="form" method="post" action="<?= $root ?>/processes/editsalon">
<input type="hidden" value="<?= $salon['id']; ?>" name="id">
<?php
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
<?php } ?>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="date">Date:</label>
      <input class="form-control datepicker" type="text" name="date" value="<?= date( 'o-m-d', strtotime( $salon['date'] )) ?>">
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="hour">Heure:</label>
      <input class="form-control" type="time" name="hour" value="<?= date( 'H:i', strtotime( $salon['date'] )) ?>">
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="nbr_person_max">Nombre de personnes max.:</label>
      <input class="form-control" type="number" name="nbr_person_max" value="20">
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="books">Oeuvre:</label>
      <input type="text" id="books" class="form-control autocomplete" value="<?= $workAssoc['name']; ?>">
      <input type="hidden" name="book" id="book_id" value="<?= $workAssoc['id']; ?>">
      <!--<i class="form-text text-muted"><small>Commencez à écrire pour des suggestions...</small></i>-->
    </div>
  </div>
</div>
<?php
    $workAssoc = $salons->getWorkOfSalon($salon['work_id']);
?>
<div class="row">
  <div class="col-sm-12 align-right">
    <button type="submit" class="btn btn-primary">Modifier</button>
  </div>
</div>
</form>

<script>
$(function(){
  $.ajax({
    url: '<?= $root; ?>/processes/worksjson',
    success: function(data){
      var json = JSON.parse(data);
      $('.autocomplete').catcomplete({
        delay: 0,
        source: json,
        select: function (event, ui) {
          $('#book_id').val(ui.item.id); 
        }
      });
    }
  });
});
</script>