<?php
  if(!isset($setid)){
    echo '<script>window.location.replace("'.$root.'/home");</script>';
  }else{
    $page = $pages->getOne($setid);
    if($page){
?>
  <h1 class="intermediate_title"><?= $page['name']; ?></h1>
  <div class="text-content">
    <?= html_entity_decode($page['content']); ?>
  </div>
<?php
    }else{
      echo '<script>window.location.replace("'.$root.'/home");</script>';
    }
  }
?>