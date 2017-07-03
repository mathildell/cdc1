<form class="form" method="post" action="<?= $root ?>/processes/newsalon">
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="date">Date:</label>
      <input class="form-control datepicker" type="text" name="date">
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="hour">Heure:</label>
      <input class="form-control" type="time" name="hour">
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="admin_salon">Administrateur du salon:</label>
      <input type="text" id="admin_salon" class="form-control autocomplete" placeholder="Commencez à écrire pour des suggestions">
      <input type="hidden" name="admin_user_id" id="admin_user_id">
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <label for="books">Oeuvre:</label>
      <input type="text" id="books" class="form-control autocomplete" placeholder="Commencez à écrire pour des suggestions">
      <input type="hidden" name="book" id="book_id">
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
</div>
<div class="row">
  <div class="col-sm-12 align-right">
    <button type="submit" class="btn btn-primary">Créer un salon</button>
  </div>
</div>
</form>

<script>
$(function(){
  $.ajax({
    url: '<?= $root; ?>/processes/worksjson',
    success: function(data){
      var json = JSON.parse(data);
      console.log(json);
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
      console.log(json);
      $('#admin_salon').autocomplete({
        source: json,
        select: function (event, ui) {
          $('#admin_user_id').val(ui.item.id); 
        }
      });
    }
  });
});
</script>