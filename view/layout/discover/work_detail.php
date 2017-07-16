
<?php
  //include 'view/layout/includes/breadcrumbs.php';
  $book = isset($_GET["id"]) ? $works->getOne($_GET["id"]) : null;
  if(isset($curr_user)){
    $exchan = $user->doIHaveThisBook($curr_user['id'], $book['id']);
  }
  if($book){
?>
<div class="row">

  <div class="col-sm-10 book-card book-xl">
    <a href="<?= $root . '/discover/' . $discover_type . '/' . $discover_cat . '/' . $book['id']; ?>" class="image-holder">
       <img src="<?= $root.$book['img_src']; ?>" />
    </a>
    <div class="book-info">
       <h3><a href="<?= $root . '/discover/' . $discover_type . '/' . $discover_cat . '/' . $book['id']; ?>"><?= $book['name']; ?></a></h3>
       <p>de <a><?= $book['author']; ?></a></p>
       <p class="tags">
          <?= '<a href="'. $root . '/discover/' . $discover_type . '">' . ucfirst($discover_type) . '</a> › <a href="'. $root . '/discover/' . $discover_type . '/' . $discover_cat . '">'. ucfirst($discover_cat) . '</a>'; ?></p>
       <div class="description">
          <?= $book['description']; ?>
       </div>
       <?php
        if(!empty($book['url_amazon'])){
        ?>
        <br><br>
          <a class="btn btn-amazon" href="<?= $book['url_amazon']; ?>" target="_blank">
            <span class="icon-amazon"></span>
            Se procurer ce <?= $discover_type; ?>
          </a>
        <?php
        }
       ?>

    </div>
  </div>
  <div class="col-sm-2 book-card book-xl">
  <?php if(isset($curr_user)){ 
    if(!$exchan){ ?>
    <form action="<?= $root; ?>/user/<?= $curr_user['id']; ?>/edit#edit_exchange" method="post" class="form">
      <input type="hidden" name="book_name_wanted" value="<?= $book['name']; ?>">
      <input type="hidden" name="book_id_wanted" value="<?= $book['id']; ?>">
      <button type="submit" class="btn btn-primary">
        J'ai/je veux ce <?= $discover_type ?> 
      </button>
    </form>
    <?php }else{ ?>
      <a class="btn btn-primary" href="<?= $root; ?>/user/<?= $curr_user['id']; ?>/edit#edit_exchange_books">
        Je ne possède / ne <br>veux plus ce <?= $discover_type ?> 
      </a>
    <?php } }?>
  </div>

</div>
<?php 
if(isset($_SESSION['loggedin'])){
  $exchanges = $user->getExchangesFromBook( $book['id'] );

  if(!empty($exchanges)){

?>
<section class="exchange">
  <h3 class="big_title">
    Pour échanger
  </h3>
<?php
  foreach ($exchanges as $key => $person) {
    $status = $user->getExStatus($person['status']);
    if($key % 4 === 0){
      echo '<div class="row">';
    }
?>
  <div class="col-sm-3 book-card book-small">
    <a href="<?= $root . '/user/'.$person['id']; ?>" class="image-holder">
       <img src="<?= $root.$person['picture']; ?>" />
    </a>
    <div class="book-info">
      <h3><a href="<?= $root . '/user/'.$person['id']; ?>"><?= $person['username']; ?></a></h3>
      <p><?= (intval($person['status']) == 2) ? '<b class="wanted">'.$status.'</b>' : $status; ?></p>
    </div>
  </div>
<?php
    if($key % 4 === 3 || $key === (count($exchanges) - 1)){
      echo '</div>';
    }
  }
?>
</section>
<?php
  }
  }
}
?>

