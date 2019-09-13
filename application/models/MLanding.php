<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MLanding extends CI_Model {

  public function getSlideShowCaption() {
    return $this->db->get('landing')->result_array();
  }

  public function getSlide($id) {
    $query = $this->db->get_where('landing', ['id' => $id]);
    $output = '';
    foreach ($query->result_array() as $row) {
      $output .= '
        <div class="container-fluid text-center">
          <img src="'.base_url('assets/images/slideshow/').$row['slide_pict'].'" class="img-fluid">
        </div>
        <br>
        <div class="container-fluid">
          <form enctype="multipart/form-data" id="form-edit">
            <div class="form-group">
              <input type="file" name="slide_pict" class="form-control-file">
              <input type="hidden" name="id" value="'.$id.'">
            </div>
            <div class="form-group">
              <label for="slide-caption">Caption</label>
              <input type="text" name="caption" class="form-control form-control-sm" maxlength="15" placeholder="'.$row['caption'].'" id="slide-caption">
            </div>
            <div class="form-group text-right">
              <button type="submit" class="btn btn-sm btn-outline-danger">Confirm <i class="far fa-check-circle"></i></button>
            </div>
          </form>
        </div>
      ';
    }
    return $output;
  }

  public function updateSlide($id, $caption, $file_ext = null) {
    if ($file_ext != null) {
      $slide_pict = $id.$file_ext;
      $this->db->query("UPDATE landing SET caption = '$caption', slide_pict = '$slide_pict' WHERE id = $id");
    } else {
      $this->db->query("UPDATE landing SET caption = '$caption' WHERE id = $id");
    }
  }
}