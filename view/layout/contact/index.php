<section class="contact-us" id="contactus">
  <?php
    if($_GET['p'] === 'contact'){
      include 'view/layout/includes/breadcrumbs.php';
    }
  ?>
    <h3 class="big_title">
      Nous contacter
    </h3>
    <form class="form" id="contactForm" method="post" action="<?= $root;?>/processes/sendadminmsg">
    <?php
    if(isset($_SESSION['loggedin'])){
    ?>
    <input type="hidden" value="<?= $curr_user['id']; ?>" name="sender_id">
    <?php
    }
    ?>
    <input type="hidden" value="<?= date('Y-m-d H:i:s'); ?>" name="timestamp">
      <div class="row">
        <div class="col-sm-6 split-lab">
          <div class="form-group">
            <label for="name">Nom &amp; prénom</label>
            <input name="sender_name" type="text" id="name" class="form-control" <?= isset($_SESSION['loggedin']) ? 'value="'.$curr_user['username'].'"' : '' ?>>
          </div>
          <div class="form-group">
            <label for="email">Adresse email</label>
            <input name="sender_email" type="email" id="email" class="form-control" <?= isset($_SESSION['loggedin']) ? 'value="'.$curr_user['email'].'"' : '' ?>>
          </div>
          <div class="form-group">
            <label for="headline">Objet du mail</label>
            <input name="sender_subject" type="text" id="headline" class="form-control">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="content">Que pouvons-nous faire pour vous ?</label>
            <textarea class="form-control" name="msg_content" rows="5" id="content"></textarea>
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