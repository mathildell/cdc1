<?php
  include 'view/layout/includes/breadcrumbs.php';
?>
<h1 class="intermediate_title">Accès aux catégories</h1>
<ul class="admin_links">
  <li><a href="<?= $root;?>/admin/salons">Salons</a></li>
  <li><a href="<?= $root;?>/admin/users">Utilisateurs</a></li>
  <li><a href="<?= $root;?>/admin/works">Oeuvres</a></li>
  <li><a href="<?= $root;?>/admin/types">Type d'oeuvres</a></li>
  <li><a href="<?= $root;?>/admin/categories">Catégories</a></li>
  <?php  ?>
  <li><a href="<?= $root;?>/admin/messages">Messagerie <?= (count($unreadsAdmin) > 0) ? ' <span class="tag unreadTag">'.count($unreadsAdmin).' non-lu</span>' : ''; ?></a></li>
  <li><a href="<?= $root;?>/admin/pages">Pages statiques</a></li>
</ul>
<hr><br>
<h2 class="intermediate_title">Données utilisateur</h2>
<div class="row">
  <div class="col-sm-12">
    <h2 class="small_title">
      Répartition de l'activité (dans chatbox) <!--en fonction du jour et de l'heure-->
    </h2>
    <div id="nbr_msg_heure"></div>
  </div>
</div>
    


<script>
$(function(){

  google.charts.load('current', {'packages':['corechart', 'line']});
  google.charts.setOnLoadCallback(drawChart);


  function drawChart() {

    $.ajax({
      url: '<?= $root; ?>/processes/json_chattimestamp',
      success: function(json_data){
        var json = JSON.parse(json_data);
        var datae = [], variable = [];
        var days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        for(var i = 0; i < 24; i++){
          if(i === 0){
          }else{
            variable = [];
            for(var e = 0; e <= 8; e++){
              if(e === 0){
                variable.push(i);
              }else if(e === 8){
                datae.push(variable);
              }else{
                day = days[e-1];
                if(typeof json[day] !== "undefined" && typeof json[day][i] !== "undefined"){
                  variable.push( json[day][i] );
                }else{
                  variable.push( 0 );
                }
              }
            }
          }
        }

        var data = new google.visualization.DataTable();
          data.addColumn('number', 'Heures');
          data.addColumn('number', 'Monday');
          data.addColumn('number', 'Tuesday');
          data.addColumn('number', 'Wednesday');
          data.addColumn('number', 'Thursday');
          data.addColumn('number', 'Friday');
          data.addColumn('number', 'Saturday');
          data.addColumn('number', 'Sunday');

          data.addRows(datae);

          var options = {
              chart: {
                //title: 'Box Office Earnings in First Two Weeks of Opening',
                subtitle: 'En nombre de messages selon l\'heure'
              },
              height: 300
            };


            var chart = new google.charts.Line(document.getElementById('nbr_msg_heure'));

            chart.draw(data, google.charts.Line.convertOptions(options));
        }
    });//ajax #1




  }//function drawchart

});
</script>