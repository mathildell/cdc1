<nav class="filters">
  <h3 class="small_title">Filtres</h3>
  <form class="form-inline" onsubmit="return false;">
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label>Type</label>
          <select class="form-control" id="type">
            <option value="all" selected>Sélectionner...</option>
            <?php 
              $types = $type->getAll();
              foreach ($types as $media) {
                echo '<option value="'.$media['id'].'">'.ucfirst($media['name']).'</option>';
              }
            ?>
          </select>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label>Genre</label>
          <select class="form-control" id="category">
            <option value="all" selected>Sélectionner...</option>
            <?php 
              $categories = $category->getAll();
              foreach ($categories as $cat) {
                echo '<option value="'.$cat['id'].'">'.ucfirst($cat['name']).'</option>';
              }
            ?>
          </select>
        </div>
      </div>
      <div class="col-sm-4" id="searchbartable">
      </div>
    </div>
  </form>
</nav>                                                                                    
<div class="table-responsive">
  <table class="table data-table">
    <thead>
      <tr>
        <th>
          Oeuvre &amp; auteur
        </th>
        <th>
          Date
        </th>
        <th>
          Salon ouvert
        </th>
        <th>
          Rejoindre
        </th>
      </tr>
    </thead>
    <tbody id="filter_salons">
      <?php
        //$root . /discover/book/comedy/1
        $salonss = $salons->getAll();
        foreach ($salonss as $sal) {
          $workAssoc = $salons->getWorkOfSalon($sal['work_id']);
          $bookType = $works->getBookType($workAssoc['id'])['name'];
          $bookGenre = $works->getBookCat($workAssoc['id'])['name'];


          echo '<tr data-type="'. $workAssoc['type_id'] . '" data-cat="'. $workAssoc['category_id'] . '"><td><a href="'. $root . '/discover/' . $bookType . '/' . $bookGenre . '/' . $workAssoc['id'] . '">' . $workAssoc['name'] . '</a> <p>par ' . $workAssoc['author'] .'</p></td><td><span style="display:none;">'.strtotime( $sal['date'] ).'</span>'.date( 'l jS F Y\, H\hi', strtotime( $sal['date'] ));
          if(strtotime( $sal['date'] ) > time()){
            $diff = strtotime( $sal['date'] ) - time();
            $days=floor($diff/(60*60*24));
            $hours=round(($diff-$days*60*60*24)/(60*60));
            if($days == 0){
              $s = ($hours > 1) ? 's' : '';
              echo ' <i>(dans '.$hours.' heure'.$s.')</i></td>';
            }else{
              $s = ($days > 1) ? 's' : '';
              echo ' <i>(dans '.$days.' jour'.$s.')</i></td>';
            }
          }
          if($sal['running'] == 1){
            echo '<td><span class="tag encours">Salon ouvert</span><span style="display:none;">'.strtotime( $sal['date'] ).'</span></td>';
          }else{
            echo '<td><span style="display:none;">'.strtotime( $sal['date'] ).'</span></td>';
          }
          if(strtotime( $sal['date'] ) > time() || intval($sal['running']) === 1){
            echo '<td><a class="btn btn-primary" href="'. $root . '/salons/' . $sal['id'] . '">Rejoindre</a></td></tr>';
          }else{
            echo '<td><a class="btn btn-default" href="'. $root . '/salons/' . $sal['id'] . '">Revoir la discussion</a></td></tr>';
          }
        }

      ?>
    </tbody>
  </table>
</div>
<script>
$(function(){
  /*
  var type_id = $('#type option:selected').val(), cat_id = $('#category option:selected').val();
  $.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var age = parseFloat( data[3] ) || 0; 

        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && age <= max ) ||
             ( min <= age   && isNaN( max ) ) ||
             ( min <= age   && age <= max ) )
        {
            return true;
        }

        return false;
    }
  );

  $('#category, #type').change( function() {
      table.draw();
  } );
  */

  var type_id = $('#type option:selected').val(), cat_id = $('#category option:selected').val();
  function update(){
    $('#filter_salons tr').hide();

    if($('#filter_salons #noresult').length > 0){
      $('#filter_salons #noresult').remove();
    }

    if(type_id === "all" && cat_id === "all"){
      $('#filter_salons tr').show();
    }else if(type_id !== "all" && cat_id === "all"){
      $('#filter_salons tr[data-cat]:hidden').show();
      $('#filter_salons tr').not('[data-type='+type_id+']').hide();
      $('#filter_salons tr[data-type='+type_id+']').show();
    }else if(type_id === "all" && cat_id !== "all"){
      $('#filter_salons tr[data-type]:hidden').show();
      $('#filter_salons tr').not('[data-cat='+cat_id+']').hide();
      $('#filter_salons tr[data-cat='+cat_id+']').show();
    }else{
      $('#filter_salons tr').hide();
      $('#filter_salons tr[data-cat='+cat_id+'][data-type='+type_id+']').show();
    }

    if($('#filter_salons tr:visible').length === 0){
      $('#filter_salons').append('<tr id="noresult"><td colspan="3">Aucun résultat</td></tr>');
    }
  }

  $('#type').change(function(){
    type_id = $('#type option:selected').val();
    update();
  });

  $('#category').change(function(){
    cat_id = $('#category option:selected').val();
    update();
  });

  update();


});



  // var search;
  // $('#searchSalons').keyup(function(e){
  //   //check if key is letter
  //   //
  //   search = $('#searchSalons').val();
  //   if(search.length > 3){
  //     //$('#filter_salons tr').html();
  //     if($('#filter_salons #noresult').length > 0){
  //       $('#filter_salons #noresult').remove();
  //     }

  //     $('#filter_salons tr').each(function(){
  //       var txt = $(this).text();
  //       if(txt.indexOf(search) >= 0){
  //         $(this).show();
  //       }else{
  //         $(this).hide();
  //         if($('#filter_salons tr:visible').length === 0){
  //           $('#filter_salons').append('<tr id="noresult"><td colspan="3">Aucun résultat</td></tr>');
  //         }
  //       }
  //     });
  //   }
  //   if(search.length === 0){
  //     $('#filter_salons tr').show();
  //     update();
  //   }
  // });
</script>