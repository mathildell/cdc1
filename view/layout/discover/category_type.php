<?php 
  //list of all categories
  $categories = $category->getAll();
  echo '

    <h3 class="small_title">Catégories</h3> 
  <ul>';
  foreach ($categories as $cat) {
    echo '<li><a href="' . $root . '/discover/' . $discover_type . '/' . $cat['name'] . '">' . ucfirst($cat['name']) . '</a></li>';
  }
  echo '</ul>';

  //list of all works from this type
  $data = [':type_id' => $type->getIdByName($discover_type)];

?>




