<?php
if($_SESSION['loggedin']){
  $editMode = isset($_GET["edit"]) ? true : false;

  if($_GET['id'] !== $curr_user['id']){
    $editMode = false;
  }

  $theUser = ($_GET['id'] !== $curr_user['id']) ? $theUser = $user->get($_GET['id']) : $theUser = $curr_user;

  if($theUser){
  ?>
  <div class="profile">
    <?php 
      $exchanges = $user->getExchanges($theUser['id']);
      $count_exchanges = count($exchanges);
      if($editMode){
        echo '<form class="form" method="post" action="'.$root.'/processes/edituser"><input type="hidden" name="userid" value="'.$curr_user['id'].'">';
      }
    ?>
    <section class="pres">
      <div class="row">
        <div class="col-sm-3 profile-pic">
          <img src="<?= $root.$theUser['picture']; ?>">
        </div>
        <div class="col-sm-7 col-sm-offset-1 profile-info">
          <?php
          if($editMode){
            echo '<div class="form-group"><label for="username">Nom d\'utilisateur:</label><input class="form-control" name="username" id="username" type="text" value="'.$theUser['username'].'"></div>';
          }else{
            if($theUser['id'] !== $curr_user['id']){
              echo '<div class="row"><div class="col-sm-8"><h3>'.$theUser['username'].'</h3></div><div class="col-sm-4"><a href="#" class="btn btn-primary">Ajouter en contact</a></div></div>';
            }else{
                echo '<h3>'.$theUser['username'].'</h3>';
            }
          }
          ?>
          <?php
          if($editMode){
            echo '<div class="form-group"><label for="email">Email:</label><input class="form-control" id="email" type="text" name="nike-email" value="'.$theUser['email'].'"></div>';
            echo '<div class="form-group"><label for="password">Mot de passe:</label><input class="form-control" id="password" type="password" name="password" value="'.$theUser['password'].'"></div>';
            echo '<div class="form-group"><label for="password_confirm">Confirmer le mot de passe:</label><input class="form-control" id="password_confirm" type="password" name="password_confirm" value="'.$theUser['password'].'"></div>';
          }else{
            echo '<p>'.$theUser['email'].'</p>';
          }
          ?>
           <div class="description" <?= ($editMode) ? 'style="max-width: 100%;"' : ""; ?>>
            <?php

            if($editMode){
              echo '<div class="form-group"><label for="description">Description:</label><textarea class="form-control" id="description" name="description">'.$theUser['description'].'</textarea></div>';
            }else{
              echo isset($theUser['description']) ? $theUser['description'] : "";
            }

            ?>
           </div>
            <?php 
              if($theUser['id'] === $curr_user['id']) {
                if($editMode){
                  echo '<button type="submit" class="btn btn-primary">Valider les modifications</button>';
                }else{
                  echo '<a class="btn btn-primary" href="'.$root.'/user/'.$theUser['id'].'/edit">Editer le profile</a>';
                }
              }
            ?>
        </div>
      </div>
    </section>
    <?php if($count_exchanges > 0 || $editMode){
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
        if($key % 3 === 2 || $key === ($count_exchanges - 1)){
          echo '</div>';
        }
        if($key === ($count_exchanges - 1) && $editMode){
          echo '<div class="row">
            <div class="col-sm-12">
            <a class="btn btn-primary" href="#">Ajouter un livre à échanger</a>
            </div>
          </div>';
        }


      }
      ?>
    </section>
      <?php
        if($editMode){
          echo '</form>';
        }
    }
    if($theUser['id'] !== $curr_user['id']){
      ?>
    <section class="contact-person">
      <h3 class="big_title">
        Contacter <?= $theUser['username']; ?>
      </h3>
        <form class="form contact-form">
          <div class="row">
            <div class="col-sm-6 split-lab">
              <div class="form-group">
                <label for="name">Nom </label>
                <input type="text" id="name" class="form-control" name="name" <?php if(isset($_SESSION['loggedin'])){ ?> value="<?= $curr_user['username']; ?>" <?php } ?>>
              </div>
              <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" id="email" class="form-control" name="email" <?php if(isset($_SESSION['loggedin'])){ ?> value="<?= $curr_user['email']; ?>" <?php } ?>>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="content">Message</label>
                <textarea class="form-control" rows="5" id="content" name="message_content"></textarea>
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
  </div>
  <?php
  }
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/home");</script>';
}
?>