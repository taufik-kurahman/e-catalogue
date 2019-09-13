<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogue extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->library('pagination');
    $this->load->model('MProducts');
  }

	public function index() {
    $data['categories'] = $this->MProducts->getCategories();
		$this->load->view('bs_head');
		$this->load->view('navbar');
		$this->load->view('catalogue', $data);
		$this->load->view('foot');
  }
  
  public function getCatalogue() {
		$config['base_url'] = base_url('catalogue');
		$config['total_rows'] = $this->MProducts->getRowsCount();
    $config['per_page'] = 9;
    $config["uri_segment"] = 3;
    $config['use_page_numbers'] = TRUE;

    $config['full_tag_open'] 	= '<nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] 	= '</ul></nav>';
		$config['num_tag_open'] 	= '<li class="page-item">';
		$config['num_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open'] 	= '<li class="page-item">';
		$config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></li>';
		$config['prev_tag_open'] 	= '<li class="page-item">';
		$config['prev_tagl_close'] 	= '</li>';
		$config['first_tag_open'] 	= '<li class="page-item">';
		$config['first_tagl_close'] = '</li>';
		$config['last_tag_open'] 	= '<li class="page-item">';
		$config['last_tagl_close'] 	= '</li>';
		$config['attributes'] = array('class' => 'page-link catalogue-link');

    $this->pagination->initialize($config);
    $page = $this->uri->segment(3);
    $start = ($page - 1) * $config['per_page'];
    $output = array(
    	'cataloguePaginationLink' => $this->pagination->create_links(),
    	'catalogue' => $this->MProducts->getProducts($config['per_page'], $start)
    );
    echo json_encode($output);
  }
  
  public function getFilteredCatalogue() {
    $search = $this->input->post('q');
    $categories = $this->input->post('categories');

		$config['base_url'] = base_url('catalogue');
		$config['total_rows'] = $this->MProducts->getFilteredRowsCount($search, $categories);
    $config['per_page'] = 9;
    $config["uri_segment"] = 3;
    $config['use_page_numbers'] = TRUE;

    $config['full_tag_open'] 	= '<nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] 	= '</ul></nav>';
		$config['num_tag_open'] 	= '<li class="page-item">';
		$config['num_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open'] 	= '<li class="page-item">';
		$config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></li>';
		$config['prev_tag_open'] 	= '<li class="page-item">';
		$config['prev_tagl_close'] 	= '</li>';
		$config['first_tag_open'] 	= '<li class="page-item">';
		$config['first_tagl_close'] = '</li>';
		$config['last_tag_open'] 	= '<li class="page-item">';
		$config['last_tagl_close'] 	= '</li>';
		$config['attributes'] = array('class' => 'page-link filtered-catalogue-link');

    $this->pagination->initialize($config);
    $page = $this->uri->segment(3);
    $start = ($page - 1) * $config['per_page'];
    $output = array(
      'search' => $search,
      'categories' => $categories,
    	'cataloguePaginationLink' => $this->pagination->create_links(),
    	'catalogue' => $this->MProducts->getFilteredProducts($config['per_page'], $start, $search, $categories)
    );
    echo json_encode($output);
	}

	public function getProductDetail() {
		$id_product = $this->input->get('id');
		$response['data'] = $this->MProducts->getProductDetail($id_product);
		echo json_encode($response);
	}

	public function getCategoryName() {
		$id_category = $this->input->get('id');
		$category = $this->MProducts->getCategory($id_category);
		$response['category_name'] = $category->category_name;
		echo json_encode($response);
	}
}
