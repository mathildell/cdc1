<?php 
  include 'view/layout/includes/breadcrumbs.php';

  $head =  '<div class="discover">
    <nav class="category_nav"';
    if(isset($discover_cat) && isset($discover_type) && isset($setid) || isset($discover_cat) && isset($discover_type) && !isset($setid)){
      $head .= ' data="detail"';
    }
    $head .= '>';
    echo $head;
    if(!isset($discover_cat) && isset($discover_type) && !isset($setid)){
        //level #1
        include 'category_type.php';
      }else if(isset($discover_cat) && isset($discover_type) && !isset($setid)){
        //level #2
        include 'category_detail.php';
      }else if(isset($discover_cat) && isset($discover_type) && isset($setid)){
        //level #3
        echo '</nav>'; 
        include 'work_detail.php';

      }else{
        include 'default.php';
      }

    if(!isset($setid)){
      echo '</nav>'; 

      include 'all_works.php';
    }

  echo '</div>';
?>