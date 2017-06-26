<?php 
  $type_id = $type->getIdByName($discover_type);
  $cat_id = $category->getIdByName($discover_cat);
  $data = [':type_id' => $type_id, ':category_id' => $cat_id];
?>




