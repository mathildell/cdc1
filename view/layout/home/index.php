<div class="home">
  <header>
    <h1 class="main_title">Club des <br>&nbsp;&nbsp;&nbsp;<i>C</i>ritiques</h1>
  </header>
  <section class="concept">
    <h3 class="big_title">
      Notre concept
    </h3>
    <div class="text-content">
      <p>Cras dictum. Maecenas ut turpis. In vitae erat ac orci dignissim eleifend. Nunc quis justo. Sed vel ipsum in purus tincidunt pharetra. Sed pulvinar, felis id consectetuer malesuada, enim nisl mattis elit, a facilisis tortor nibh quis leo.</p>
      <p>Sed augue lacus, pretium vitae, molestie eget, rhoncus quis, elit. Donec in augue. Fusce orci wisi, ornare id, mollis vel, lacinia vel, massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
      <p>Duis eros mi, dictum vel, fringilla sit amet, fermentum id, sem. Phasellus nunc enim, faucibus ut, laoreet in, consequat id, metus. Vivamus dignissim. Cras lobortis tempor velit. Phasellus nec diam ac nisl lacinia tristique. Nullam nec metus id mi dictum dignissim. Nullam quis wisi non sem lobortis condimentum. Phasellus pulvinar, nulla non aliquam eleifend, tortor wisi scelerisque felis, in sollicitudin arcu ante lacinia leo.</p>
      <p>Sed pulvinar, felis id consectetuer malesuada, enim nisl mattis elit, a facilisis tortor nibh quis leo. Sed augue lacus, pretium vitae, molestie eget, rhoncus quis, elit. Donec in augue. Fusce orci wisi, ornare id, mollis vel, lacinia vel, massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
      <p>Suspendisse vestibulum dignissim quam. Integer vel augue. Phasellus nulla purus, interdum ac, venenatis non, varius rutrum, leo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis a eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce magna mi, porttitor quis, convallis eget, sodales ac, urna. Phasellus luctus venenatis magna. Vivamus eget lacus. Nunc tincidunt convallis tortor. </p>
    </div>
  </section>


  <?php
    $books = $works->getAllWhere([':spotlight' => 1 ]);
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
               <p>de <a href="#"><?= $book['author']; ?></a></p>
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