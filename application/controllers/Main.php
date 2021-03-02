<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

	}
	
	
	public function index()
	{
		$data['title'] = '  ';

		$this->load->view('template/headerMain', $data);
		$this->load->view('main/index');
		$this->load->view('template/footerMain');			
	}
}