<!DOCTYPE html>
<html>
<head>
  <title><?= (isset($_GET["p"]) && !empty($_GET["p"])) ? ucfirst($_GET["p"]) : "Club des Critiques"; ?> | Club des Critiques</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= $root; ?>/view/assets/css/app.css">
  <script src="<?= $root; ?>/view/assets/js/jquery-3.2.1.min.js"></script>
  <script src="<?= $root; ?>/view/assets/js/datatable.min.js"></script>
  <script src="<?= $root; ?>/view/assets/js/jquery.hotkeys.js"></script>
  <script src="<?= $root; ?>/view/assets/js/bootstrap-wysiwyg.js"></script>
  <script src="<?= $root; ?>/view/assets/js/jquery-ui.min.js"></script>
  <script src="<?= $root; ?>/view/assets/js/googlechart.js"></script>
  <script src="<?= $root; ?>/view/assets/sass/vendor/bootstrap/javascripts/bootstrap.min.js"></script>
  <link rel="shortcut icon" type="image/x-icon" href="<?= $root; ?>/favicon.ico">
  <script>
  $(function(){

    $( 'input.datepicker').datepicker({
      'dateFormat': 'yy-mm-dd',
      'showAnim': 'fadeIn'
    });

    $.widget( "custom.catcomplete", $.ui.autocomplete, {
      _create: function() {
        this._super();
        this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
      },
      _renderMenu: function( ul, items ) {
        var that = this,
          currentCategory = "";
        $.each( items, function( index, item ) {
          var li;
          if ( item.category != currentCategory ) {
            ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
            currentCategory = item.category;
          }
          li = that._renderItemData( ul, item );
          if ( item.category ) {
            li.attr( "aria-label", item.category + " : " + item.label );
          }
        });
      }
    });



    var table = $('.data-table').DataTable({
      "order": [[ 0, "desc" ]],
      <?php 
        if(isset($_GET['p'])){
          if(isset($_GET['cat']) && $_GET['cat'] === "admin"){
            if($_GET['p'] === "messages"){
              echo '"order": [[ 3, "desc" ]],';
            }else if($_GET['p'] === "salons"){
              if(!isset($_GET['id'])){
                echo '"order": [[ 3, "desc" ]],';
              }
            }
          }else{
            if($_GET['p'] === "salons"){
              echo '
                "order": [[ 2, "desc" ]],
                "initComplete": function(settings, json) {
                  var input = $("#DataTables_Table_0_filter").detach().find("input");
                  input.addClass("form-control");
                  $("#searchbartable").append("<div class=\"form-group\"><label>Search</label>");
                  input.appendTo($("#searchbartable .form-group"));
                  $("#searchbartable").append("</div>");
                }';

            }else if($_GET['p'] === "user" && isset($_GET['messages'])){
              echo '"order": [[ 3, "desc" ]],';
            }
          }
        }
      ?>


    });

    
    
    $('#searchbar').click(function(e){
      e.preventDefault();
      if($('#searchThrough').hasClass('active')){
        $('#searchThrough').removeClass('active');
        $('#searchbar').attr({'class':'icon-search'});
      }else{
        $('#searchThrough').addClass('active');
        $('#searchbar').attr({'class':'icon-x'});
      }
    });
  });
    
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#uploadImage').attr('src', e.target.result);
            console.log(e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }
  </script>
</head>
<body>