<section class="exchange" id="edit_exchange_books">
  <h3 class="big_title">
    Pour échanger
  </h3>
  <form class="form" method="post" action="<?= $root; ?>/processes/edituserexchange"><input type="hidden" name="userid" value="<?= $curr_user['id']; ?>">
    <input type="hidden" value="<?= $count_exchanges; ?>" name="count_exchanges">
    <?php 
    foreach ($exchanges as $key => $book) {
      $book_type = $works->getBookType($book["id"]);
      $book_cat = $works->getBookCat($book["id"]);
      if($key % 3 === 0){
      ?>
      <div class="row">
      <?php
      }
      ?>
      <div class="col-sm-4 book-card">
        <a href="<?= $root . '/discover/' . $book_type['name']  . '/' . $book_cat['name'].'/'.$book['id']; ?>" class="image-holder">
           <img src="<?= $book['img_src']; ?>" />
        </a>
        <div class="book-info">
           <h3><a href="<?= $root . '/discover/' . $book_type['name']  . '/' . $book_cat['name'].'/'.$book['id']; ?>"><?= $book['name']; ?></a></h3>
          <p>de <a href="#"><?= $book['author']; ?></a></p>
          <input type="hidden" value="<?= $book['ex_id']; ?>" name="exchange_id_<?= $key + 1; ?>">
          <input type="hidden" value="<?= $book['id']; ?>" name="exchange_workid_<?= $key + 1; ?>">
          <div class="form-group">
            <label for="status">Status:</b>
            <select class="form-control" name="status_<?= $key + 1; ?>" id="status_<?= $key + 1; ?>">
              <option value="0" <?= ($book['status'] == 0) ? 'selected' : '' ?>>À prêter</option>
              <option value="1" <?= ($book['status'] == 1) ? 'selected' : '' ?>>Prêté</option>
              <option value="2" <?= ($book['status'] == 2) ? 'selected' : '' ?>>Je le veux</option>
              <option value="3">Je ne suis plus intéréssé</option>
            </select>
          </div>
        </div>
      </div>

      <?php
      if($key % 3 === 2 || $key === ($count_exchanges - 1)){
      ?>
      </div>
      <?php
      }
    }
    if($count_exchanges > 0){
    ?>
    <hr> <br>
    <?php
    }
    include 'form_exchange.php';
    ?>
  </form>
</section>