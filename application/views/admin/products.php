<div class="row">
  <div class="col-12">
    <div class="card p-2">
      <div class="container-fluid p-2">
        <button class="btn btn-sm btn-outline-danger" id="btn-add">Add new <i class="fas fa-plus"></i></button>
      </div>
      <div class="container-fluid p-2">
        <div class="table-responsive">
          <table id="products-table" class="table table-striped table-bordered dataTable" style="border-spacing:0px;">
            <thead>
              <tr>
                <th class="text-center" width="5%">No.</th>
                <th class="text-center">Name</th>
                <th class="text-center">Price</th>
                <th class="text-center">Available</th>
                <th width="10%" class="text-center">Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-add" tabindex="-1" role="dialog" id="modal-add">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-light bg-custom-red">
        <h5 class="modal-title">Add Product</h5>
        <button type="button" class="btn bg-transparent" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="far fa-times-circle fa-2x text-light"></i></span>
        </button>
      </div>
      <div class="modal-body" id="modal-add-body">
        <form id="form-add" enctype="multipart/form-data">
          <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control form-control-sm" id="category" name="id_category">
              <?php
                foreach ($categories as $category) {
                  echo '<option value="'.$category['id_category'].'">'.$category['category_name'].'</option>';
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control form-control-sm">
          </div>
          <div class="form-group">
            <label for="product_price">Product Price</label>
            <input type="number" name="product_price" id="product_price" class="form-control form-control-sm" min="0" value="0">
          </div>
          <div class="form-group">
            <label for="product_desc">Product Description</label>
            <textarea class="form-control" name="product_desc" id="product_desc" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="product_discount">Product Discount</label>
            <input type="number" name="product_discount" id="product_discount" class="form-control form-control-sm" min="0" value="0">
          </div>
          <div class="form-group">
            <label for="available">Available</label>
            <select class="form-control form-control-sm" id="available" name="available">
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>
          <div class="form-group">
            <input type="file" class="form-control-file" name="product_pict" required>
          </div>
          <div class="form-group text-right">
            <button type="submit" class="btn btn-sm btn-outline-danger">Confirm <i class="far fa-check-circle"></i></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-edit" tabindex="-1" role="dialog" id="modal-edit">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-light bg-custom-red">
        <h5 class="modal-title">Edit Product</h5>
        <button type="button" class="btn bg-transparent" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="far fa-times-circle fa-2x text-light"></i></span>
        </button>
      </div>
      <div class="modal-body" id="modal-edit-body">
        
      </div>
    </div>
  </div>
</div>

<script>
  $('#products-link').addClass('active');

  loadProducts();

  $(document).on('click', '.btn-edit', function(e) {
    $.ajax({
      url: "<?= base_url('admin/getProductDetailForEdit'); ?>",
      type: "GET",
      data: {id: $(this).attr('data-id')},
      dataType: "JSON",
      success: function(response) {
        $('#modal-edit-body').html(response.data);
        $('#modal-edit').modal('show');
      }
    });
  });

  $(document).on('submit', '#form-edit', function(e) {
    e.preventDefault();
    $.ajax({
      url: "<?= base_url('admin/updateProduct'); ?>",
      type: "POST",
      data: new FormData(this),
      processData: false,
      contentType: false,
      dataType: "JSON",
      success: function(response) {
        if (response.updated) {
          location.href = "<?= base_url('admin/pages/products'); ?>";
        } else {
          Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: response.message.replace(/(<([^>]+)>)/ig,"")
          })
        }
      }
    });
  })

  $(document).on('click', '#btn-add', function(e) {
    $('#modal-add').modal('show');
  });

  $(document).on('submit', '#form-add', function(e) {
    e.preventDefault();
    $.ajax({
      url: "<?= base_url('admin/addProduct'); ?>",
      type: "POST",
      data: new FormData(this),
      processData: false,
      contentType: false,
      dataType: "JSON",
      success: function(response) {
        if (response.added) {
          location.href = "<?= base_url('admin/pages/products'); ?>";
        } else {
          Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: response.message.replace(/(<([^>]+)>)/ig,"")
          })
        }
      }
    });
  })

  $(document).on('click', '.btn-delete', function(e) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "<?= base_url('admin/deleteProduct'); ?>",
          type: "POST",
          data: {id: $(this).attr('data-id')},
          dataType: "JSON",
          success: function(response) {
            location.href = "<?= base_url('admin/pages/products'); ?>";
          }
        });
      }
    })
  });

  function loadProducts() {
    var table = $('#products-table').DataTable({
      "destroy": true,
      "processing": true,
      "serverSide": true,
      "order": [[ 1, 'asc' ]],
      "ajax": {
        url: "<?php echo base_url().'admin/getProducts'; ?>",
        type: "POST"
      },
      "columnDefs":[
        {
          "targets":[0],
          "orderable":false,
          
        },
        {
          "targets":[4],
          "orderable":false
        }
      ],
      "aoColumns":[
        null,
        null,
        null,
        null,
        {"className": "text-center"}
      ],
      drawCallback: function() {
        var api = this.api();
        var num_rows = api.page.info().recordsTotal;
        var records_displayed = api.page.info().recordsDisplay;
        var perpage = api.page.info().length;
        var page = api.page.info().page;
      }
    });
    
    table.on( 'draw.dt', function () {
      var PageInfo = $('#products-table').DataTable().page.info();
      var records_displayed_perpage = 0;
      table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
        records_displayed_perpage = records_displayed_perpage + 1;
      });
    });
  }

</script>