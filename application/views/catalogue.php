<div class="container-fluid pt-2">
  <div class="row">
    <div class="col-md-3 pb-2">
      <div class="heading-wrapper">
        Filters
      </div>
      <br>
      <form id="filters-form">
        <div class="form-group">
          <input type="text" class="form-text" placeholder="Type anything here !" id="search-box" name="q">
        </div>
        <div class="text-center text-danger">
          --Categories--
        </div>
        <div class="form-group">
          <?php
            foreach ($categories as $category) {
              echo'
                <label class="cb-container">'.$category['category_name'].'
                  <input type="checkbox" name="categories[]" value="'.$category['id_category'].'">
                  <span class="checkmark"></span>
                </label>
              ';
            }
          ?>
        </div>
        <div class="form-group text-center">
          <button class="btn btn-sm btn-outline-danger btn-width">Search <i class="fas fa-search"></i></button>
        </div>
      </form>
    </div>
    <div class="col-md-9">
      <div class="card p-2" style="min-height: 100vh;">
        <div class="row" id="catalogue">

        </div>
        <br>
        <div id="catalogue-pagination">

        </div>
      </div>
    </div>
  </div>
</div>
<br>
<div class="container-fluid text-light bg-custom-red text-center p-2">
  <small>&copy;2019</small>
  <br>
  <small>lorem ipsum</small>
</div>

<div class="modal fade modal-detail" tabindex="-1" role="dialog" id="modal-detail">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-light bg-custom-red">
        <h5 class="modal-title">Product Details</h5>
        <button type="button" class="btn btn-transparent" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="far fa-times-circle fa-2x text-light"></i></span>
        </button>
      </div>
      <div class="modal-body" id="modal-body">
        
      </div>
    </div>
  </div>
</div>

<script>
  let last_search = null;
  let last_categories = [];
  $('#navbar').addClass(['navbar-light', 'bg-alpha']);
  $('#catalogue-link').addClass('active');

  loadCatalogue(1);

  $(document).on("click", ".pagination li a.catalogue-link", function(e){
    e.preventDefault();
    var page = $(this).data("ci-pagination-page");
    loadCatalogue(page);
  });

  $(document).on("click", ".pagination li a.filtered-catalogue-link", function(e){
    e.preventDefault();
    var page = $(this).data("ci-pagination-page");
    $.ajax({
      url: "<?= base_url('catalogue/getFilteredCatalogue/'); ?>"+page,
      method: "POST",
      data: {q: last_search, categories: last_categories},
      dataType: "JSON",
      success: function(response) {
        $("#catalogue").html(response.catalogue);
        $("#catalogue-pagination").html(response.cataloguePaginationLink);
      }
    });
  });

  $(document).on("click", ".btn-detail", function(e) {
    $.ajax({
      url: "<?= base_url('catalogue/getProductDetail'); ?>",
      method: "GET",
      data: {id: $(this).attr('data-id')},
      dataType: "JSON",
      success: function(response) {
        $('#modal-body').html(response.data);
        $('#modal-detail').modal('show');
      }
    });
  });

  $(document).on("submit", "#filters-form", function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    if (formData.get('q') == '' && formData.get('categories[]') == null) {
      loadCatalogue(1);
    } else {
      $.ajax({
        url: "<?= base_url('catalogue/getFilteredCatalogue/1'); ?>",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function(response) {
          last_search = response.search;
          last_categories = response.categories;
          if(last_search != null) $('#search-box').val(last_search);
          if (response.catalogue == '') {
            let message = '<div class="text-center container"><h3>No result found for </h3>';
            if (last_search != null) {
              message += '<span class="text-danger">' + last_search + '</span>';
            }
            if (last_categories != null) {
              message += '<br> at ';
              for (let i = 0; i < last_categories.length; i++) {
                $.ajax({
                  url: "<?= base_url('catalogue/getCategoryName'); ?>",
                  method: "GET",
                  async: false,
                  data: {id: last_categories[i]},
                  dataType: "JSON",
                  success: function(response) {
                    message += '<span class="badge badge-danger">' + response.category_name + '</span> ';
                  }
                });
              }
              message += 'categories.';
            }
            message += '</div>';
            $("#catalogue").html(message);
            $("#catalogue-pagination").html('');
          } else {
            $("#catalogue").html(response.catalogue);
            $("#catalogue-pagination").html(response.cataloguePaginationLink);
          }
        }
      });
    }
  });

  function loadCatalogue(page) {
    $.ajax({
      url: "<?= base_url('catalogue/getCatalogue/'); ?>"+page,
      method: "GET",
      dataType: "JSON",
      success: function(response) {
        $("#catalogue").html(response.catalogue);
        $("#catalogue-pagination").html(response.cataloguePaginationLink);
      }
    });
  }
</script>