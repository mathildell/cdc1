<div class="row">
  <div class="col-sm-8">
    <h1 class="intermediate_title">
      <?= $countBooks; ?> oeuvre<?= ($countBooks > 1) ? 's' : ''; ?>
    </h1>      
  </div>
  <div class="col-sm-4 align-right">
    <a class="btn btn-primary" href="<?= $root;?>/admin/works/new">Créer une nouvelle oeuvre</a>  
  </div>
</div>          
<div class="table-responsive">
  <table class="table data-table">
    <thead>
      <tr>
        <th>
          ID
        </th>
        <th>
          Type
        </th>
        <th>
          Name
        </th>
        <th>
          Auteur
        </th>
        <th>
          Catégorie
        </th>
        <th>
          Actions
        </th>
      </tr>
    </thead>
    <tbody>
    <?php 
      foreach ($theBooks as $key => $book) {
        $bookType = $works->getBookType($book['id']);
        $bookCat = $works->getBookCat($book['id']);
    ?>
      <tr>
        <td>
          <?= isset($book['id']) ? $book['id'] : ''; ?>
        </td>
        <td>
            <?= isset($bookType) ? $bookType['name'] : ''; ?>
        </td>
        <td>
          <a href="<?= $root; ?>/discover/<?= isset($bookType) ? $bookType['name'] : ''; ?>/<?= isset($bookCat) ? $bookCat['name'] : ''; ?>/<?= isset($book['id']) ? $book['id'] : ''; ?>">
            <?= isset($book['name']) ? $book['name'] : ''; ?>
          </a>
        </td>
        <td>
          <?= isset($book['author']) ? $book['author'] : ''; ?>
        </td>
        <td>
          <?= isset($bookCat) ? $bookCat['name'] : ''; ?>
        </td>
        <td>
          <form id="deletework_<?= $book['id']; ?>" action="<?= $root; ?>/processes/deletework" method="post" onsubmit="event.preventDefault();"><a class="btn btn-primary" href="<?= $root.'/admin/works/'.$book['id'].'/edit'; ?>">edit</a><input type="hidden" name="book_id" value="<?= $book['id']; ?>"><input type="submit" class="btn btn-danger" onclick="confirmDelete(<?= $book['id']; ?>)" value="delete"></form>
        </td>
      </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
</div>
<script>
function confirmDelete(id){
  if(confirm('Are you sure?')){
    document.getElementById('deletework_'+id).submit();
  }
  return false;
}
</script>