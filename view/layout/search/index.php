<?php
  if(isset($_POST['search_query'])){

  $query = htmlspecialchars($_POST['search_query']);
  $searchResults = $works->searchFor($query);
  $resultsNbr = count($searchResults);

?>
<div class="search">
  <h2 class="medium_title">
    Vous avez cherché "<i><?= $query; ?></i>"
  </h2>
  <p class="nmbr_search"><?= $resultsNbr; ?> résultat<?= ($resultsNbr != 1) ? 's' : ''; ?></p>
  <p>
    <?php 
      if(count($searchResults) > 0){
        foreach ($searchResults as $key => $book) {

          $book_type = $works->getBookType($book["id"]);
          $book_cat = $works->getBookCat($book["id"]);
          if($key % 3 === 0){
            echo '<div class="row">';
          }
          ?>
            <div class="col-sm-4 book-card">
              <a href="<?= $root . '/discover/' . $book_type['name']  . '/' . $book_cat['name'].'/'.$book['id']; ?>" class="image-holder">
                 <img src="<?= $book['img_src']; ?>" />
              </a>
              <div class="book-info">
                 <h3><a href="#"><?= $book['name']; ?></a></h3>
                 <p>de <a><?= $book['author']; ?></a></p>
                 <p class="tags">
                    <?= '<a href="'. $root . '/discover/' . $book_type['name'] . '">' . ucfirst($book_type['name']) . '</a> › <a href="'. $root . '/discover/' . $book_type['name'] . '/' . $book_cat['name'] . '">'. ucfirst($book_cat['name']) . '</a>'; ?></p>
              </div>
            </div>

          <?php

          if($key % 3 === 2 || $key === ($resultsNbr - 1)){
            echo '</div>';
          }
        }
      }else{
        echo 'Pas de résultat';
      }
    ?>
  </p>

</div>
<?php

  }else{
?>
<script>window.location.replace("<?= $root; ?>/discover");</script>
<?php
  }
?>