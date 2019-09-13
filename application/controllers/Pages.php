<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct() {
    parent::__construct();
    
    $this->load->Model(['MLanding', 'MProducts']);
	}

	public function index($page=null, $act=null) {
		$this->load->view('admin/templates/header');
		if ($this->session->userdata('login') !== null) {
			$this->load->view('admin/top_wrapper');
			switch ($page) {
				case 'slide-show':
					$data['slideshows'] = $this->MLanding->getSlideShowCaption();
					$this->load->view('admin/slide_show', $data);
				break;
					case 'products':
					$data['categories'] = $this->MProducts->getCategories();
					$this->load->view('admin/products', $data);
					break;
				default:
					$this->load->view('admin/slide_show');
					break;
			}
			$this->load->view('admin/bot_wrapper');
		} else {
			redirect(base_url('admin'));
		}
		$this->load->view('admin/templates/footer');
	}

}