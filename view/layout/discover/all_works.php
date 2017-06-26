<?php
$books = isset($data) ? $works->getAllWhere($data) : $works->getAll();

if($books){

    foreach ($books as $key => $book) {
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
             <p>de <a href="#"><?= $book['author']; ?></a></p>
          </div>
        </div>

      <?php

      if($key % 3 === 2 || $key === (count($books) - 1)){
        echo '</div>';
      }

    }

}else{
  echo 'Nothing to show';
}