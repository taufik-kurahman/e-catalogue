<div class="row">
  <div class="col-12">
    <div class="card p-2">
      <div class="container-fluid p-2">
        <div class="table-responsive">
          <table id="slide-table" class="table table-striped table-bordered dataTable" style="border-spacing:0px;">
            <thead>
              <tr>
                <th class="text-center" width="5%">Slide</th>
                <th class="text-center">Image</th>
                <th class="text-center">Caption</th>
                <th width="5%" class="text-center">Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($slideshows as $slide) {
                  echo '
                    <tr>
                      <td>'.$slide['id'].'</td>
                      <td><img src="'.base_url('assets/images/slideshow/').$slide['slide_pict'].'" width="50px"></td>
                      <td>'.$slide['caption'].'</td>
                      <td><button type="button" class="btn btn-sm btn-outline-danger btn-edit" data-id="'.$slide['id'].'"><i class="fas fa-pencil-alt"></i></button></td>
                    </tr>
                  ';
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-edit" tabindex="-1" role="dialog" id="modal-edit">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-light bg-custom-red">
        <h5 class="modal-title">Edit Slide</h5>
        <button type="button" class="btn bg-transparent" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="far fa-times-circle fa-2x text-light"></i></span>
        </button>
      </div>
      <div class="modal-body" id="modal-body">
        
      </div>
    </div>
  </div>
</div>

<script>
  $('#slide-link').addClass('active');

  $('.btn-edit').on('click', function(e) {
    $.ajax({
      url: "<?= base_url('admin/getSlide'); ?>",
      type: "GET",
      data: {id: $(this).attr('data-id')},
      dataType: "JSON",
      success: function(response) {
        $('#modal-body').html(response.data);
        $('#modal-edit').modal('show');
      }
    });
  });

  $(document).on('submit', '#form-edit', function(e) {
    e.preventDefault();
    $.ajax({
      url: "<?= base_url('Admin/updateSlide'); ?>",
      type: "POST",
      data: new FormData(this),
      processData: false,
      contentType: false,
      dataType: "JSON",
      success: function(response) {
        if (response.updated) {
          location.href = "<?= base_url('admin/pages/slide-show'); ?>";
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

</script>