<?php
if($_SESSION['loggedin']){
  $editMode = isset($_GET["edit"]) ? true : false;

  if($_GET['id'] !== $curr_user['id']){
    $editMode = false;
  }

  $theUser = ($_GET['id'] !== $curr_user['id']) ? $theUser = $user->get($_GET['id']) : $theUser = $curr_user;

  $msgMode = (isset($_GET['messages']) && $_GET['id'] === $curr_user['id']) ? true : false;

  if($msgMode){
    include 'message.php';
  }else{
    if($theUser){
    ?>
    <div class="profile">
      <?php 
        $exchanges = $user->getExchanges($theUser['id']);
        $count_exchanges = count($exchanges);
        if($editMode){
          include 'edit_profile.php'; 
          include 'edit_exchange.php'; 
        }else{
          include 'profile.php';
        }
      ?>
    </div>
    <?php
    }
  }
    
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}
?>
<script>
<?php if($editMode){
?>
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
$('#add_exchange').change(function(){
  if($(this).is(':checked')){
    $('.add_exchange_row').show();
  }else{
    $('.add_exchange_row').hide();
  }
});
<?php
}
?>
$(function(){
  $('.btn-file input').change(function(e) {
      readURL(this);
  });

});
</script>