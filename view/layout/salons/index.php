<div class="salons">
  <?php 
    include 'view/layout/includes/breadcrumbs.php';
    if(!isset($setid)){
      include 'view/layout/salons/list.php';
    }else{
      include 'view/layout/salons/details.php';
    }
  ?>
</div>