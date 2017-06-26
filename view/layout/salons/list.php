<nav class="filters">
  <h3 class="small_title">Filtres</h3>
  <form class="form-inline">
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label>Type</label>
          <select class="form-control">
            <option value="x" disabled selected>Sélectionner...</option>
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
          <select class="form-control">
            <option value="x" disabled selected>Sélectionner...</option>
            <?php 
              $categories = $category->getAll();
              foreach ($categories as $cat) {
                echo '<option value="'.$cat['id'].'">'.ucfirst($cat['name']).'</option>';
              }
            ?>
          </select>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="searchSalons">Recherche</label>
          <input type="text" class="form-control" name="searchSalons" id="searchSalons" placeholder="Rechercher un titre, un auteur...">
        </div>
      </div>
    </div>
  </form>
</nav>                                                                                    
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>
          Oeuvre &amp; auteur
        </th>
        <th>
          Date
        </th>
        <th>
          Rejoindre
        </th>
      </tr>
    </thead>
    <tbody>
      <?php
        //$root . /discover/book/comedy/1
        $salonss = $salons->getAll();
        foreach ($salonss as $sal) {
          $workAssoc = $salons->getWorkOfSalon($sal['work_id']);
          $bookType = $works->getBookType($workAssoc['id'])['name'];
          $bookGenre = $works->getBookCat($workAssoc['id'])['name'];
          echo '<tr data-type="'. $workAssoc['type_id'] . '" data-category="'. $workAssoc['category_id'] . '"><td><a href="'. $root . '/discover/' . $bookType . '/' . $bookGenre . '/' . $workAssoc['id'] . '">' . $workAssoc['name'] . '</a> <p>par ' . $workAssoc['author'] .'</p></td><td>'.date( 'l jS F Y\, H\hi', strtotime( $sal['date'] )).'</td><td><a class="btn btn-primary" href="'. $root . '/salons/' . $sal['id'] . '">Rejoindre</a></td></tr>';
        }

      ?>
    </tbody>
  </table>
</div>