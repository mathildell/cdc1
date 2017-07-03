<?php
if($_SESSION['loggedin']){
$salonDetails  = $salons->getOne($setid);
$bookDetails = $works->getOne($salonDetails['work_id']);
$bookCategory = $works->getBookCat($bookDetails["id"])['name'];
$bookType = $works->getBookType($bookDetails["id"])['name'];
$hasVoted = $salons->hasVoted($setid, $curr_user['id']);
$grades  = $salons->getGrades($setid);
$gradesCount = count($grades);
?>
<div class="details">
<?php
  if($curr_user['id'] === $salonDetails['admin_salon_id']){
?>
<div class="row">
  <div class="col-sm-5"> 
    <h3 class="small_title">
      <?= (intval(date('G')) > 4 && intval(date('G')) < 18) ? 'Bonjour '.ucfirst($curr_user['username']) : 'Bonsoir '.ucfirst($curr_user['username']); ?>,
    </h3>
    <br>
    <p>
      Vous avez été choisis par les administrateurs du Club des Critiques en tant que modérateur de ce salon.
    </p>
    <br>
    <p>
      De ce fait, vous pouvez éditer sa date et son heure de commencement, le marquer comme "en cours", et éditer l'oeuvre sur laquelle il portera. 
    </p>
    <br>
    <div class="align-right">
      <a href="<?= $root; ?>/admin/salons/<?= $salonDetails['id']; ?>/edit" class="btn btn-primary">Éditer le salon</a>
    </div>
  </div>
  <div class="col-sm-6 col-sm-offset-1"> 
    <p>
      À la fin de ce salon, vous devrez donner une note sur quatre* à chacun de ses participants selon ces critères :
    </p>
    <br>
    <ul style="list-style-type: disc; padding-left: 30px;">
      <li>
        <b>Participation</b>
        <ul style="list-style-type: circle; padding-left: 30px;">
          <li>Quantité de la prise de parole</li>
          <li>Qualité de la prise de parole</li>
          <li>Orthographe</li>
        </ul>
      </li>
      <li>
        <b>Comportement</b>
        <ul style="list-style-type: circle; padding-left: 30px;">
          <li>Politesse &amp; bienséance</li>
        </ul>
      </li>
    </ul>
    <br>
    <p><i style="color: gray;">* En aucun cas cette note ne doit se baser sur l'opinion personelle du participant.</i></p>
  </div>
</div>
<br> <hr> <br>
<?php
  }
?>
  <div class="row">
    <div class="<?= ($hasVoted || strtotime( $salonDetails['date'] ) < time() ) ? 'col-sm-9 book-card book-xl' : 'col-sm-4 book-card'; ?>">
      <a href="<?= $root . '/discover/' . $bookType . '/' . $bookCategory . '/' . $bookDetails['id']; ?>" class="image-holder">
         <img src="<?= $bookDetails['img_src']; ?>" />
      </a>
      <div class="book-info">
         <h3><a href="<?= $root . '/discover/' . $bookType . '/' . $bookCategory . '/' . $bookDetails['id']; ?>"><?= $bookDetails['name']; ?></a></h3>
         <p>de <a href="#"><?= $bookDetails['author']; ?></a></p>
         <p class="tags">
            <?= '<a href="'. $root . '/discover/' . $bookType . '">' . ucfirst($bookType) . '</a> › <a href="'. $root . '/discover/' . $bookType . '/' . $bookCategory . '">'. ucfirst($bookCategory) . '</a>'; ?></p>
         <div class="description">
            <?= ($hasVoted || strtotime( $salonDetails['date'] ) < time() ) ? $bookDetails['description'] : substr($bookDetails['description'], 0, 120).'...'; ?>
         </div>
      </div>
    </div>
    <div class="<?= ($hasVoted || strtotime( $salonDetails['date'] ) < time() ) ? 'col-sm-3 onlineInChat' : 'col-sm-8 align-center'; ?>">
    <?php if($hasVoted || (strtotime($salonDetails['date']) <  time()) ){ ?>
      <h3 class="small_title"><span id="onlineSalons"><?= $gradesCount; ?></span> participant<?= ($gradesCount > 1) ? 's' : ''; ?></h3> 
      <ul class="userList">
        <?php
        foreach ($grades as $key => $grade) {
        ?>
        <li>
          <img src="<?= $root . $grade['picture']; ?>">
          <h4><a href="<?= $root; ?>/user/<?= $grade['user_id']; ?>"><?= $grade['username']; ?></a></h4>
          <span class="notes align-right" data-grade="<?= $grade['grade']; ?>"></span>
        </li>
        <?php
        }
        ?>
      </ul>
      <?php 
        if(!(strtotime( $salonDetails['date'] ) < time())){
      ?>
      <div class="align-right">
        <a class="btn btn-primary" id="invit">
          Inviter un ami
        </a>
      </div>
      <form class="form invit_friend" style="display: none;">
        <hr>
        <div class="form-group">
          <label for="friend_email">Inviter un ami:&nbsp;&nbsp;&nbsp;</label>
          <input type="email" name="friend_email" id="friend_email" class="form-control" placeholder="Entrez leur adresse email">
        </div>
        <div class="align-right">
          <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
      </form>
    <?php 
          }
      }else{
      ?>
      <h3 class="intermediate_title"> 
        Qu'avez-vous pensé de <?= $bookDetails['name']; ?> ?
      </h3> 
      <i class="disclaimer">Une notre sur quatre est requise pour participer au salon</i>
      <form class="form grade" action="<?= $root; ?>/processes/registervote" method="post">
        <input type="hidden" name="work_id" value="<?= $bookDetails['id']; ?>">
        <input type="hidden" name="salon_id" value="<?= $setid; ?>">
        <input type="hidden" name="user_id" value="<?= $curr_user['id']; ?>">
        <div class="form-group" data-grade="1">
          <label for="grade_book_1"></label>
          <input type="radio" id="grade_book_1" name="grade_book" value="1">
        </div>
        <div class="form-group" data-grade="2">
          <label for="grade_book_2"></label>
          <input type="radio" id="grade_book_2" name="grade_book" value="2">
        </div>
        <div class="form-group" data-grade="3">
          <label for="grade_book_3"></label>
          <input type="radio" id="grade_book_3" name="grade_book" value="3">
        </div>
        <div class="form-group" data-grade="4">
          <label for="grade_book_4"></label>
          <input type="radio" id="grade_book_4" name="grade_book" value="4">
        </div>
        <div class="form-group" style="display: block;">
          <button type="submit" class="btn btn-primary">Valider</button>
        </div>
      </form>
      <?php
      } ?>
    </div>
  </div>
  <?php 
    if(
      ( 
        intval($salonDetails['running']) > 0 
        //|| !( strtotime( $salonDetails['date'] ) < time() )
      )
      && $hasVoted
      
    ){ 
    //salon en cours ?>
  <hr><br><br>
  <h2 class="intermediate_title">Discussion sur le <?= $bookType; ?></h2>
  <div class="row"> 
    <div class="col-sm-8">
      <iframe class="chatbox chatbox-current" src="<?= $root; ?>/chatbox/<?= $salonDetails['id']; ?>"></iframe>
    </div>
    <div class="col-sm-4">
      <input type="hidden" value="<?= $curr_user['id']; ?>" name="user_id" id="user_id">
      <input type="hidden" value="<?= $salonDetails['id']; ?>" name="salon_id" id="salon_id">
      <form class="form" id="sendmessage"> 
        <h3 class="small_title">Composez un message...</h3>
        <br>
        <div class="form-group">
          <textarea class="form-control" rows="7"></textarea>
        </div>
        <div class="align-right">
          <input type="submit" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>
<?php
  }else if( strtotime( $salonDetails['date'] ) < time() ){
    if(count($salons->getChatMessages($_GET['id'])) > 0){
?>
  <hr><br><br>
  <h2 class="intermediate_title">Discussion sur le <?= $bookType; ?></h2>
  <div class="chat-past">
    <iframe class="chatbox chatbox-old" src="<?= $root; ?>/chatbox/<?= $salonDetails['id']; ?>"></iframe>
  </div>
<?php
    }
  }
?>
</div>
<script>
$(function(){
  function toBottom(){
    var $contents = $('.chatbox-current').contents();
    $contents.scrollTop($contents.height());
  }
  setTimeout(toBottom, 100);
  $('#sendmessage').submit(function(e){
    e.preventDefault();
    var data = { 
      "message": $('textarea', this).val(),
      "user_id": $('#user_id').val() ,
      "salon_id": $('#salon_id').val() 
    };
    $.ajax({
      data: data,
      url: "<?= $root; ?>/processes/sendchatbox",
      method: "POST",
      success: function(result){
        $('#sendmessage textarea').val("");
        setTimeout(toBottom, 100);
      }
    });
  });

  $('.chatbox').hover(function(){
    $('body').css({'overflow-y':'hidden'});
  },function(){
    $('body').css({'overflow-y':'auto'});
  });


  $('#invit').click(function(){
    $('form.invit_friend').slideToggle();
  });

  var grade, isChecked = false;
  $('form.grade .form-group[data-grade] input').change(function(){
    if($(this).is(':checked')){
      isChecked = $(this).parent().data('grade');
    }else{
      isChecked = false;
    }
  });

  $('form.grade .form-group[data-grade]').hover(function(){
    grade = parseInt($(this).data('grade'));
    if(isChecked){
      $('.form-group[data-grade]').removeClass('active')
    }
    for(var i = grade; i >= 0; i--){
      $('.form-group[data-grade="'+i+'"]').addClass('active');
    }
  }, function(){
      if(!isChecked){ 
        $('.form-group[data-grade]').removeClass('active');
      }else{
        for(var i = isChecked; i >= 0; i--){
          $('.form-group[data-grade="'+i+'"]').addClass('active');
        }
      }
      
  });

});
</script>
<?php
}else{
  $_SESSION['feedback'] = 'notallowed';
  echo '<script>window.location.replace("'.$root.'/login");</script>';
}
?>