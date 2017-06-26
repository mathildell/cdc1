<?php
  //include 'view/layout/includes/breadcrumbs.php';
  $book = isset($_GET["id"]) ? $works->getOne($_GET["id"]) : null;
  if($book){
?>
<div class="row">

  <div class="col-sm-12 book-card book-xl">
    <a href="<?= $root . '/discover/' . $discover_type . '/' . $discover_cat . '/' . $book['id']; ?>" class="image-holder">
       <img src="<?= $book['img_src']; ?>" />
    </a>
    <div class="book-info">
       <h3><a href="<?= $root . '/discover/' . $discover_type . '/' . $discover_cat . '/' . $book['id']; ?>"><?= $book['name']; ?></a></h3>
       <p>de <a href="#"><?= $book['author']; ?></a></p>
       <p class="tags">
          <?= '<a href="'. $root . '/discover/' . $discover_type . '">' . ucfirst($discover_type) . '</a> › <a href="'. $root . '/discover/' . $discover_type . '/' . $discover_cat . '">'. ucfirst($discover_cat) . '</a>'; ?></p>
       <div class="description">
          <?= $book['description']; ?>
       </div>

    </div>
  </div>

</div>

<?php
  }
?>

