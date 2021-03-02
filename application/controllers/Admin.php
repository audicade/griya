<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		
		parent::__construct();
		is_logged_in();	
		
	}
	
	
	public function index(){
		
		
		$data['title'] = 'Anggota';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('template/footer');
	}
	
	
	public function ban(){
	
	
	$data['title'] = 'Akun yang Dicekal';
	$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
	
	$this->load->view('template/header', $data);
	$this->load->view('template/sidebar', $data);
	$this->load->view('template/topbar', $data);
	$this->load->view('admin/ban', $data);
	$this->load->view('template/footer');
	}	
	
	public function IsActive(){
		
	$id = $this->input->post('id');
	
	$this->db->set('is_active', 0);
	$this->db->where('id', $id);
	$this->db->update('user');

	$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Akun telah dicekal</div>');
	redirect('admin');


	}

	public function IsBanned(){
		
	$id = $this->input->post('id');
	
	$this->db->set('is_active', 1);
	$this->db->where('id', $id);
	$this->db->update('user');

	$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Akun telah diaktifkan</div>');
	redirect('admin');


	}


	
	
}