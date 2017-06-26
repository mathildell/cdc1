<h1 class="intermediate_title">
  <?= $countBooks; ?> travaux
</h1>                
<div class="table-responsive">
  <table class="table user-table">
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
          <?= isset($book['name']) ? $book['name'] : ''; ?>
        </td>
        <td>
          <?= isset($book['author']) ? $book['author'] : ''; ?>
        </td>
        <td>
          <?= isset($bookCat) ? $bookCat['name'] : ''; ?>
        </td>
        <td>
          <a class="btn btn-primary" href="<?= $root.'/admin/works/'.$book['id'].'/edit'; ?>">edit</a>
          <a class="btn btn-danger">delete</a>
        </td>
      </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
</div>