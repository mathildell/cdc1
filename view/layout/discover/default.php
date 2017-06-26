<?php 
  $types = $type->getAll();

  echo '
    <h3 class="small_title">Médias</h3> 
  <ul>';
  foreach ($types as $media) {
    echo '<li><a href="' . $root . '/' . $page . '/' . $media['name'] . '">' . ucfirst($media['name']) . '</a></li>';
  }
  echo '</ul>';

?>




