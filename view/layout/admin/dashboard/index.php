<?php
  if(
    $_SESSION['loggedin']
    && isset($curr_user)
    && $curr_user['isAdmin'] == 1
  ){
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
<br><hr><br>
<div class="row">
  <div class="col-sm-6">
    <h2 class="small_title">
      Genres les plus populaires
    </h2>
    <div id="fav_genres"></div>
  </div>
  <div class="col-sm-6">
    <h2 class="small_title">
      Répartition des notes attribuées
    </h2>
    <div id="percent_notes"></div>
  </div>
</div>
<br><hr><br>
<div class="row">
  <div class="col-sm-6">
    <h2 class="small_title">
      Répartition des utilisateurs les plus actifs (limité à 5)
    </h2>
    <div id="most_active_users"></div>
  </div>
  <div class="col-sm-6">
    <h2 class="small_title">
      Utilisateurs échangeant le plus de livres (5)
    </h2>
    <div id="most_books"></div>
  </div>
</div>
<!--
- nombre d'oeuvres par type 
- combien d'utilisateurs à de contacts en moyenne
- quels utilisateurs empruntent le plus 
  / quels utilisateurs pretent le plus
- utilisateurs les plus populaires

- % de l'ensemble des notes attribuées 
  par un seul utilisateur
-->
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
              height: 300,
              hAxis: {
                viewWindow: {
                    min: 6,
                    max: 23
                }
              }
            };


            var chart = new google.charts.Line(document.getElementById('nbr_msg_heure'));
            chart.draw(data, google.charts.Line.convertOptions(options));
        }
    });//ajax #1

    function getRandomColor() {
      var colors = ['#EF5350', '#EC407A', '#AB47BC', '#7E57C2', '#5C6BC0','#42A5F5', '#29B6F6', '#26C6DA', '#26A69A', '#66BB6A', '#66BB6A', '#D4E157', '#FFEE58', '#FFCA28', '#FFA726', '#FF7043', '#8D6E63', '#78909C'];
      return colors[Math.floor(Math.random() * colors.length)];
    }

    $.ajax({
      url: '<?= $root; ?>/processes/json_popular_cats',
      success: function(json_data){

        var json = JSON.parse(json_data);
        var datae = [];
        datae.push(['Catégories', 'Nombre d\'oeuvres', { role: 'style' }]);
        $.each(json, function(name, nbr){
          datae.push([name, nbr,  getRandomColor() ]);
        });
        var data = google.visualization.arrayToDataTable(datae);

        var options = {
          chart: {
            subtitle: 'Répartition du nombre d\'heures par catégories'
          },
          height: 300,
          bar: {groupWidth: "90%"},
          legend: { position: "none" }
        };

        //var chart = new google.visualization.PieChart(document.getElementById('fav_genres'));

        var chart = new google.visualization.BarChart(document.getElementById("fav_genres"));
        chart.draw(data, options);


      }
    });//ajax #2

    $.ajax({
      url: '<?= $root; ?>/processes/json_get_notes',
      success: function(json_data){

        var json = JSON.parse(json_data);
        var datae = [];
        datae.push(['Grade', 'Number', { role: 'style' }]);
        $.each(json, function(grade, nbr){
          var prez;
          if(grade == 1){
            prez = "★☆☆☆";
          }else if(grade == 2){
            prez = "★★☆☆";
          }else if(grade == 3){
            prez = "★★★☆";
          }else if(grade == 4){
            prez = "★★★★";
          }
          datae.push([ prez+' ('+grade+'/4)', nbr,  getRandomColor() ]);
        });

        var data = google.visualization.arrayToDataTable(datae);

        var options = {
          chart: {
            subtitle: 'Répartition du nombre d\'heures par catégories'
          },
          height: 300
        };
        var chart = new google.visualization.PieChart(document.getElementById('percent_notes'));
        chart.draw(data, options);
      }
    });//ajax #3


    $.ajax({
      url: '<?= $root; ?>/processes/json_most_active_users',
      success: function(json_data){

        var json = JSON.parse(json_data);
        
        var datae = [];
        datae.push(['User ID', 'Number']);
        $.each(json, function(key, user){
          datae.push([ user.name, user.count ]);
        });

        var data = google.visualization.arrayToDataTable(datae);

        var options = {
          chart: {
            subtitle: 'Répartition du nombre d\'heures par catégories'
          },
          height: 300
        };
        var chart = new google.visualization.PieChart(document.getElementById('most_active_users'));
        chart.draw(data, options);
        
      }
    });//ajax #4


    $.ajax({
      url: '<?= $root; ?>/processes/json_most_books',
      success: function(json_data){

        var json = JSON.parse(json_data);
        var datae = [];

        //case 0: return "À prêter"; break;
        //case 1: return "Prêté"; break;
        //case 2: return "Je le veux"; break;

        datae.push(['User',  'À prêter', 'Prêté']);
        var var1, var2;
        $.each(json, function(key, data){
          
          var1, var2;
          if(typeof data[0] !== "undefined"){
            var1 = data[0];
          }else{
            var1 = 0;
          }
          if(typeof data[1] !== "undefined"){
            var2 = data[1];
          }else{
            var2 = 0;
          }

          datae.push([data.name, var1, var2]);
          

        });

        var data = google.visualization.arrayToDataTable(datae);

            var options = {
              chart: {
                subtitle: 'Répartition du nombre d\'heures par catégories'
              },
              vAxis: {title: 'Accumulation'},
              legend: { position: "none" },
              isStacked: true,
              height: 300
            };

            var chart = new google.visualization.SteppedAreaChart(document.getElementById('most_books'));

            chart.draw(data, options);
          }
    }); //ajax #5


  }//function drawchart

});
</script>
<?php
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}