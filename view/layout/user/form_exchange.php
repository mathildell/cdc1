<div id="edit_exchange">
  <div class="row">
    <div class="col-sm-12">
      <h3 class="small_title">
        <input type="checkbox" name="add_exchange" id="add_exchange" <?= isset($_POST['book_id_wanted']) ? 'checked' : '' ?>>
        <label for="add_exchange">Ajouter un livre à échanger</label>
      </h3>
      <br>
    </div>
  </div> 
  <div class="row add_exchange_row" <?= !isset($_POST['book_id_wanted']) ? 'style="display: none;"' : '' ?>>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="book">Book:</label>
        <?php
          if(isset($_POST['book_id_wanted'])){
        ?>
        <input type="text" id="books" class="form-control autocomplete" value="<?= $_POST['book_name_wanted']; ?>">
        <input type="hidden" name="book" id="book_id" value="<?= $_POST['book_id_wanted']; ?>">
        <?php
          }else{
        ?>
        <input type="text" id="books" class="form-control autocomplete">
        <input type="hidden" name="book" id="book_id">
        <?php
          }
        ?>
        <!--
        <select id="books" name="book" class="form-control">
          <?php 
          if(isset($_POST['book_id_wanted'])){
          ?>
            <option value="<?= intval($_POST['book_id_wanted']); ?>" selected disabled><?= $_POST['book_name_wanted']; ?></option>
          <?php
          }else{
            foreach($works->getAllWhere(['is_deleted' => 0]) as $key => $book){ 
            ?>
            <option value="<?= $book['id']; ?>" data-type="<?= $book['type_id']; ?>" data-cat="<?= $book['category_id']; ?>"><?= $book['name']; ?></option>
          <?php 
            } 
          }
          ?>
        </select>
        -->

      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="status_new">Status:</label>
        <select id="status_new" name="status_new" class="form-control">
          <option value="0">À prêter</option>
          <option value="1">Prêté</option>
          <option value="2">Je le veux</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12 align-right">
      <button type="submit" class="btn btn-primary">Modifier les échanges</button>
    </div>
  </div>
</div>