<?php
  if(intval($salons->getOne($_GET['id'])['running']) > 0){
    echo '<meta http-equiv="refresh" content="5">';
  }
?>
<div class="salons">
  <div class="chat">
  <?php
    $allChat = $salons->getChatMessages($_GET['id']);
    foreach ($allChat as $key => $user) {
    ?>

    <div class="message<?= ($user['user_id'] === $curr_user['id']) ? ' me' : ''; ?>">
      <div class="message-content">
        <?= $user['messages']; ?>
      </div>
      <div class="sender<?= ($user['user_id'] === $curr_user['id']) ? ' align-right' : ''; ?>">
        <a target="_parent" href="<?= $root.'/user/'.$user['user_id']; ?>">
          <img src="<?= $root.$user['picture']; ?>" alt="<?= $user['username']; ?>">
          <span><?= $user['username']; ?></span>
        </a>
        <datetime>
          <?= $user['timestamp']; ?>
        </datetime>
      </div>
    </div>

    <?php
    }
  ?>
  </div>
</div>
</body>
</html>