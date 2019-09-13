<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('MLanding');
	}

	public function index()
	{
		$data['slideshows'] = $this->MLanding->getSlideShowCaption();

		$this->load->view('landing_head');
		$this->load->view('navbar');
		$this->load->view('landing', $data);
		$this->load->view('foot');
	}
}
