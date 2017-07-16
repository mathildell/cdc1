<div class="home">
  <header>
    <h1 class="main_title">Club des <br>&nbsp;&nbsp;&nbsp;<i>C</i>ritiques</h1>
  </header>
  <section class="concept">
    <h3 class="big_title">
      <?php $aboutus = $pages->getOne(5); echo $aboutus['name']; ?>
    </h3>
    <div class="text-content">
      <?= ($aboutus['content']) ? html_entity_decode($aboutus['content']) : ''?>
    </div>
  </section>


  <?php
    $books = $works->getAllWhere([':spotlight' => 1, ':is_deleted' => 0 ]);
    if(count($books) > 0){
      ?>
    <section class="top-books">
      <h3 class="big_title">
        À la une
      </h3>
      <div class="books-content">
      <?php

        foreach ($books as $key => $book) {
          $book_type = $works->getBookType($book["id"])['name'];
          $book_cat = $works->getBookCat($book["id"])['name'];
          if($key % 3 === 0){
            echo '<div class="row">';
          }
          ?>


          <div class="col-sm-4 book-card">
            <a href="<?= $root . '/discover/' . $book_type  . '/' . $book_cat.'/'.$book['id']; ?>" class="image-holder">
               <img src="<?= $book['img_src']; ?>" />
            </a>
            <div class="book-info">
               <h3><a href="#"><?= $book['name']; ?></a></h3>
               <p>de <a><?= $book['author']; ?></a></p>
               <p class="tags">
                  <?= '<a href="'. $root . '/discover/' . $book_type . '">' . ucfirst($book_type) . '</a> › <a href="'. $root . '/discover/' . $book_type . '/' . $book_cat . '">'. ucfirst($book_cat) . '</a>'; ?></p>
            </div>
          </div>

          <?php

          if($key % 3 === 2 || $key === (count($books) - 1)){
            echo '</div>';
          }
        }
      ?> 
      </div>
    </section>

      <?php
    }


    include 'view/layout/contact/index.php';
  ?>
  



</div>