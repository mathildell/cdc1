<?php
  $salonDetails  = $salons->getOne($setid);
  $bookDetails = $works->getOne($salonDetails['work_id']);
  $bookCategory = $works->getBookCat($bookDetails["id"])['name'];
  $bookType = $works->getBookType($bookDetails["id"])['name'];
?>
<div class="details">
  <div class="row">
    <div class="col-sm-9 book-card book-xl">
      <a href="<?= $root . '/discover/' . $bookType . '/' . $bookCategory . '/' . $bookDetails['id']; ?>" class="image-holder">
         <img src="<?= $bookDetails['img_src']; ?>" />
      </a>
      <div class="book-info">
         <h3><a href="<?= $root . '/discover/' . $bookType . '/' . $bookCategory . '/' . $bookDetails['id']; ?>"><?= $bookDetails['name']; ?></a></h3>
         <p>de <a href="#"><?= $bookDetails['author']; ?></a></p>
         <p class="tags">
            <?= '<a href="'. $root . '/discover/' . $bookType . '">' . ucfirst($bookType) . '</a> › <a href="'. $root . '/discover/' . $bookType . '/' . $bookCategory . '">'. ucfirst($bookCategory) . '</a>'; ?></p>
         <div class="description">
            <?= $bookDetails['description']; ?>
         </div>
      </div>
    </div>
    <div class="col-sm-3 onlineInChat">
      <h3 class="small_title"><span id="onlineSalons">32</span> participants</h3> 
      <ul class="userList">
        <li>
          <img src="<?= $root . '/view/assets/img/no-preview.png'; ?>">
          <h4>Ethel Davis</h4>
          <span class="notes one"></span>
        </li>
      </ul>
      <a class="btn btn-primary">Inviter un ami</a>
    </div>

  </div>

  <div class="chat">
    <div style="width: 100%; height: 400px; background-color: lightgrey;margin-bottom: 30px;"></div>
    <form class="form">
      <div class="form-group">
        <textarea class="form-control"></textarea>
      </div>
      <input type="submit" class="btn btn-primary">
    </form>
  </div>

</div>