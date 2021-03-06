<section class="pres">
  <div class="row">
    <div class="col-sm-3 profile-pic">
      <img src="<?= $root.$theUser['picture']; ?>" id="uploadImage" >
    </div>
    <div class="col-sm-8 col-sm-offset-1 profile-info">
      <h3><?= $theUser['username']; ?></h3> 
      <div class="info">
        <?= $theUser['email']; ?>
        <?php 
          $grades = $user->getGrades($theUser['id']);
          if(!empty($grades)){
        ?>
        <?php
            $total = [];
            foreach ($grades as $key => $grad) {
              if(intval($grad['grade_user']) > 1){ array_push($total, $grad['grade_user']); }
            } 
            if(!empty($total)){ 
            $avg = round(array_sum($total)/count($total), 2);
            $avgNum = round($avg, 0);
            ?>
          &nbsp;&nbsp;&nbsp;
          |
          &nbsp;&nbsp;&nbsp;
            <div class="grade">  
              <div class="form-group active">
                <label></label>
              </div>
              <div class="form-group<?= ($avgNum >= 2) ? ' active' : ''; ?>">
                <label></label>
              </div>
              <div class="form-group<?= ($avgNum >= 3) ? ' active' : ''; ?>">
                <label></label>
              </div>
              <div class="form-group<?= ($avgNum >= 4) ? ' active' : ''; ?>">
                <label></label>
              </div>
              <h4 class="grade_count"><span><?= $avg; ?></span> /4</h4>
            </div>
            <?php
          ?>
          <?php
            }
          }
        ?>
      </div>
      <div class="description">
        <?= isset($theUser['description']) ? $theUser['description'] : ""; ?>
      </div>
      <?php 
      if($theUser['id'] === $curr_user['id']) {
      ?>
        <a class="btn btn-primary" href="<?= $root; ?>/user/<?= $theUser['id']; ?>/edit"> 
          Éditer le profil 
        </a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="btn btn-primary" href="<?= $root; ?>/user/<?= $theUser['id']; ?>/messages">
          Voir mes messages
        </a>
      <?php
      }else{
        $friend = $user->areWeFriends($curr_user['id'], $theUser['id']);
        if($friend){
        ?>
        <form action="<?= $root; ?>/processes/rmfriend" method="post"> 
          <input type="hidden" name="friend_id" value="<?= $theUser['id']; ?>">
          <input type="hidden" name="friendship_id" value="<?= $friend['id']; ?>">
          <button type="submit" class="btn btn-primary">Supprimer des contacts</button> 
        </form> 
        <?php
        }else{
        ?>
        <form action="<?= $root ?>/processes/addfriend" method="post"> 
          <input type="hidden" name="friend_id" value="<?= $theUser['id']; ?>">  
          <button type="submit" class="btn btn-primary"> 
            Ajouter en contact
          </button> 
        </form> 
        <?php
        }
      }
    ?> 
    </div>       
  </div>
</section>
  <?php $mysalons = $user->mySalons($theUser['id']); 
  if(!empty($mysalons)){ ?>
<section class="mes_salons clearfix">
  <h3 class="big_title">Mes salons</h3>
  <?php 
  foreach ($mysalons as $key => $theSalon) {
  ?>
    <div class="col-sm-4 book-card">
      <a href="<?= $root; ?>/discover/<?= $theSalon['type']; ?>/<?= $theSalon['category']; ?>/<?= $theSalon['work_id']; ?>" class="image-holder">
         <img src="<?= $theSalon['img_src']; ?>" />
      </a>
      <div class="book-info">
        <h3>Salon n°<?= $theSalon['salon_id']; ?></a></h3>
        <h4><a href="<?= $root; ?>/discover/<?= $theSalon['type']; ?>/<?= $theSalon['category']; ?>/<?= $theSalon['work_id']; ?>"><?= $theSalon['name']; ?></a></h4>
        <p class="friends">Organisé le <i><?= date( 'l jS F \à H\hi', strtotime( $theSalon['date'] )); ?></i></p><br>
        <?php 
          $hasVoted = $salons->hasVoted($theSalon['salon_id'], $curr_user['id']);
          if(!$hasVoted && ($theSalon['running'] == 1 || strtotime( $theSalon['date'] ) > time()) ){
          ?>
          <a class="btn btn-primary btn-small" href="<?= $root; ?>/salons/<?= $theSalon['salon_id']; ?>">S'inscrire</a>
          <?php
          }else if($hasVoted && ($theSalon['running'] == 1 || strtotime( $theSalon['date'] ) > time()) ){
          ?>
          <a class="btn btn-primary btn-small" href="<?= $root; ?>/salons/<?= $theSalon['salon_id']; ?>">À venir</a>
          <?php
          }else{
          ?>
          <a class="btn btn-default btn-small" href="<?= $root; ?>/salons/<?= $theSalon['salon_id']; ?>">Discussion</a>
          <?php
          }
        ?>
      </div>
    </div>
  <?php
  }
  ?>
</section>
<?php 
}
if($count_exchanges > 0){
?>
<section class="exchange">
  <h3 class="big_title">
    Pour échanger
  </h3>
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
         <p>de <a><?= $book['author']; ?></a></p>
         <p class="status">Status: <span><?= $user->getExStatus($book['status']); ?></span></p>
      </div>
    </div>

    <?php
    if($key % 3 === 2 || $key === ($count_exchanges - 1)){
    ?>
    </div>
    <?php
    }
  }
  ?>
</section>
<?php 
} //if($count_exchanges > 0)

if($theUser['id'] === $curr_user['id']){
  $friends = $user->getFriends($curr_user['id']);
  $countFriends = count($friends);
  if($countFriends > 0){
?>
<section class="contacts">
  <h3 class="big_title">
    Mes contacts
  </h3>
  <?php
  foreach ($friends as $key => $person) {
    if($key % 4 === 0){
    ?>
    <div class="row">
    <?php
    }
  ?>
  <div class="col-sm-3 book-card book-small">
    <a href="<?= $root . '/user/'.$person['id']; ?>" class="image-holder">
       <img src="<?= $root.$person['picture']; ?>" />
    </a>
    <div class="book-info">
      <h3><a href="<?= $root . '/user/'.$person['id']; ?>"><?= $person['username']; ?></a></h3>
      <p class="friends">Ami depuis le <i><?= date( 'l jS F Y', strtotime( $person['timestamp'] )); ?></i></p>
    </div>
  </div>
  <?php
    if($key % 4 === 3 || $key === (count($friends) - 1)){
    ?>
    </div>
    <?php
    }
  }//foreach
  ?>
</section>
<?php
  }//if($countFriends > 0)
}//if($theUser['id'] === $curr_user['id'])
else{
?>
<section class="contact-person">
  <h3 class="big_title">
    Contacter <?= $theUser['username']; ?>
  </h3>
  <form class="form contact-form" method="post" action="<?= $root;?>/processes/sendmessage">
    <input type="hidden" name="userid" value="<?= $curr_user['id']; ?>">
    <input type="hidden" name="receiver_id" value="<?= $theUser['id']; ?>">
    <input type="hidden" name="timestamp" value="<?= date('Y-m-d H:i:s'); ?>">
    <div class="row">
      <div class="col-sm-6 split-lab">
        <div class="form-group">
          <label for="sender_name">Nom </label>
          <input type="text" id="sender_name" class="form-control" name="sender_name" <?php if(isset($_SESSION['loggedin'])){ ?> value="<?= $curr_user['username']; ?>" <?php } ?>>
        </div>
        <div class="form-group">
          <label for="sender_email">Adresse email</label>
          <input type="email" id="sender_email" class="form-control" name="sender_email" <?php if(isset($_SESSION['loggedin'])){ ?> value="<?= $curr_user['email']; ?>" <?php } ?>>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="content">Message</label>
          <textarea class="form-control" rows="5" id="msg_content" name="msg_content"></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <input type="submit" class="btn btn-primary pull-right">
      </div>
    </div>
  </form>
</section>
<?php
}
?>