<div class="breadcrumbs">

  <b>Vous êtes ici : </b>

  <?php 
  $breadcrumbs = array_values($_GET);

  switch ($breadcrumbs[0]) {
    case 'discover':
      $currPage = $works->getOne($setid)["name"];
      break;

    case 'salons':
      $currPage = $works->getOne($salons->getOne($setid)['work_id'])["name"];
      break;

    case 'admin':
      if($breadcrumbs[1] === "users"){
        $currPage = $user->get($setid)["username"];
      }else if($breadcrumbs[1] === "works"){
        $currPage = $works->getOne($setid)["name"];
      }else if($breadcrumbs[1] === "salons"){
        $currPage = $works->getOne($salons->getOne($setid)['work_id'])["name"];
      }else if($breadcrumbs[1] === "types"){
        $currPage = $type->getOne($setid)["name"];
      }else if($breadcrumbs[1] === "categories"){
        $currPage = $category->getOne($setid)["name"];
      }else if($breadcrumbs[1] === "pages"){
        $currPage = $pages->getOne($setid)["name"];
      }else{
        $currPage = "";
      }
      
      break;

    default:
      $currPage = "";
      break;
  }

  foreach ($breadcrumbs as $key => $pag) {
    if($pag){
      $link = $root;
      for($i = 0; $i <= $key; $i++){
        $link .= '/' . $breadcrumbs[$i];
      }
        if($breadcrumbs[0] === "admin" && is_numeric($pag)){
        }else{
          if($key === (count($breadcrumbs)-1) && isset($setid)){
            echo '<a href="' . $link . '"> ' . ucfirst( $currPage ) . ' </a>';
          }else{
            echo '<a href="' . $link . '">' . ucfirst($pag) . '</a>';
          }
        }
        
  
      
    }

  }
  
?>

</div>