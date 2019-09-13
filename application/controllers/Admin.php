<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
    $this->load->library('form_validation');
    $this->load->Model(['User', 'MLanding', 'MProducts']);
	}
	
	public function index() {
    $data['slideshows'] = $this->MLanding->getSlideShowCaption();

		$this->load->view('admin/templates/header');
		if ($this->session->userdata('login') !== null) {
			$this->load->view('admin/top_wrapper');
			$this->load->view('admin/slide_show', $data);
			$this->load->view('admin/bot_wrapper');
		} else {
			$this->load->view('admin/login');
		}
		$this->load->view('admin/templates/footer');
	}

	public function login() {
		if ($this->session->userdata('login') !== null) {redirect('');}

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/templates/header');
			$this->load->view('admin/login');
			$this->load->view('admin/templates/footer');
		} else {
			$validate = $this->User->login();
			if ($validate['email'] == false) {
				$this->session->set_flashdata('response', '<div class="alert alert-danger" role="alert">Wrong email !</div>');
			} else {
				if ($validate['password'] == false) {
					$this->session->set_flashdata('response', '<div class="alert alert-danger" role="alert">Wrong password !</div>');
				} else {
					$this->session->set_userdata(['login' => true, 'email' => htmlspecialchars($this->input->post('email', true)),'current_password' => $this->input->post('password')]);
				}
			}
			redirect(base_url('admin'));
		}
	}

	public function logout() {
		$this->session->unset_userdata('login');
		$this->session->unset_userdata('current_password');
		redirect(base_url('admin'));
  }
  
  public function getSlide() {
    $id = $this->input->get('id');
    $response['data'] = $this->MLanding->getSlide($id);
    echo json_encode($response);
  }

  public function updateSlide() {
    $id = $this->input->post('id');
    $caption = $this->input->post('caption');
    if (empty($_FILES['slide_pict']['name'])) {
      $response['updated'] = true;
      $this->MLanding->updateSlide($id, $caption, null);
    } else {
      $config['upload_path'] = './assets/images/slideshow/';
      $config['file_name'] = $id;
      $config['allowed_types'] = 'jpg';
      $config['max_size'] = 5000;
      $config['max_width'] = 0;
      $config['max_height'] = 0;
      $config['overwrite'] = TRUE;
      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('slide_pict')) {
        $response['updated'] = false;
        $response['message'] = $this->upload->display_errors();
      } else {
        $response['updated'] = true;
        $this->MLanding->updateSlide($id, $caption, $this->upload->data('file_ext'));
      }
    }

    echo json_encode($response);
  }

  public function getProducts() {
		$fetch_data = $this->MProducts->getProductsByAdmin();
		$data = array();
		foreach($fetch_data as $row) {
			$sub_array = array();
      $sub_array[] = null;
			$sub_array[] = $row->product_name;
      $sub_array[] = $row->product_price;
      if ($row->available == 1) {
        $sub_array[] = 'Yes';
      } else {
        $sub_array[] = 'No';
      }
      $sub_array[] = '
        <button class="btn btn-sm bg-transparent btn-edit" data-id="'.$row->id_product.'"><i class="fas fa-pencil-alt"></i></button>
        <button class="btn btn-sm bg-transparent btn-delete" data-id="'.$row->id_product.'"><i class="fas fa-trash-alt"></i></button>
      ';
			$data[] = $sub_array;
		}
		$output = array(
    	"draw"                =>     intval($_POST["draw"]),
			"recordsTotal"        =>     $this->MProducts->getProductsByAdminNumRows(),
      "recordsFiltered"     =>     $this->MProducts->getProductsByAdminFilteredData(),
      "data"                =>     $data
    );
    echo json_encode($output);
  }

  public function getProductDetailForEdit() {
    $id_product =  $this->input->get('id');
    $response['data'] = $this->MProducts->getProductDetailForEdit($id_product);
    echo json_encode($response);
  }

  public function updateProduct() {
    $id_product = $this->input->post('id_product');
    $id_category = $this->input->post('id_category');
    $product_name = $this->input->post('product_name');
    $product_price = $this->input->post('product_price');
    $product_desc = $this->input->post('product_desc');
    $product_discount = $this->input->post('product_discount');
    $available = $this->input->post('available');


    if (empty($_FILES['product_pict']['name'])) {
      $response['updated'] = true;
      $this->MProducts->updateProduct($id_product, $id_category, $product_name, $product_desc, $product_price, null, $product_discount, $available);
    } else {
      $config['upload_path'] = './assets/images/products/';
      $config['file_name'] = $id_product;
      $config['allowed_types'] = 'png|jpg';
      $config['max_size'] = 5000;
      $config['max_width'] = 0;
      $config['max_height'] = 0;
      $config['overwrite'] = TRUE;
      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('product_pict')) {
        $response['updated'] = false;
        $response['message'] = $this->upload->display_errors();
      } else {
        $response['updated'] = true;
        $product_pict = $id_product.$this->upload->data('file_ext');
        $this->MProducts->updateProduct($id_product, $id_category, $product_name, $product_desc, $product_price, $product_pict, $product_discount, $available);
      }
    }

    echo json_encode($response);
  }

  public function addProduct() {
    $id_product = $this->MProducts->getNewID();
    $id_category = $this->input->post('id_category');
    $product_name = $this->input->post('product_name');
    $product_price = $this->input->post('product_price');
    $product_desc = $this->input->post('product_desc');
    $product_discount = $this->input->post('product_discount');
    $available = $this->input->post('available');

    $config['upload_path'] = './assets/images/products/';
    $config['file_name'] = $id_product;
    $config['allowed_types'] = 'png|jpg';
    $config['max_size'] = 5000;
    $config['max_width'] = 0;
    $config['max_height'] = 0;
    $config['overwrite'] = TRUE;
    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('product_pict')) {
      $response['added'] = false;
      $response['message'] = $this->upload->display_errors();
    } else {
      $response['added'] = true;
      $product_pict = $id_product.$this->upload->data('file_ext');
      $this->MProducts->addProduct($id_product, $id_category, $product_name, $product_desc, $product_price, $product_pict, $product_discount, $available);
    }

    echo json_encode($response);
  }

  public function deleteProduct() {
    $id_product = $this->input->post('id');
    $this->MProducts->deleteProduct($id_product);
    $response['deleted'] = true;
    echo json_encode($response);
  }
}