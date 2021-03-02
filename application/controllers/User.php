<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		
		parent::__construct();
		is_logged_in();
		
	}
	
	
	public function index(){
		
		
		$data['title'] = 'Profil Saya';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('template/footer');
	}
	
	
	public function edit(){
		
		$data['title'] = 'Ubah Profil';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		
		
		if($this->form_validation->run() == false){
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('template/footer');	
		} else {
			
			// upload gambar
			$upload_image = $_FILES['image']['name'];
			
			if($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']		 = '2048';
				$config['upload_path']	 = './assets/img/profile/';
				
				$this->load->library('upload', $config);
				
				if($this->upload->do_upload('image')){
					$old_image = $data['user']['image'];
					
					//hapus gambar lama
					if($old_image != 'default.jpg'){
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}
					
					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
				
			}
			
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			
			$this->db->set('username', $username);
			$this->db->where('email', $email);
			$this->db->update('user');
			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Profil anda telah diperbaharui</div>');
			redirect('user');
			
		}
		
		
		
	}
	

	public function changepassword(){
		
		
		$data['title'] = 'Ubah Password';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Repeat Password', 'required|trim|matches[new_password]');
		
		if($this->form_validation->run() == false){
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('user/changepassword', $data);
			$this->load->view('template/footer');	
		
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password');
			if(!password_verify($current_password, $data['user']['password'])){
				
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password lama salah!</div>');
				redirect('user/changepassword');
			} else{
				if ($current_password == $new_password){
					
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password baru tidak boleh sama dengan password lama!</div>');
					redirect('user/changepassword');
					
				} else {
					// password benar
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
					
					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');
					
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password telah diubah</div>');
						redirect('user/changepassword');

				}
				
			}
			
		}
		
	}
	
        public function editb(){
        		
        		
    		$data['title'] = 'Edit Profile';
    		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    		
    		$this->load->view('template/header', $data);
    		$this->load->view('template/sidebar', $data);
    		$this->load->view('template/topbar', $data);
    		$this->load->view('user/edit', $data);
    		$this->load->view('template/footer');
        	}
        	
        	
         public function changepasswordb(){
        		
        		
    		$data['title'] = 'Change Password';
    		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    		
    		$this->load->view('template/header', $data);
    		$this->load->view('template/sidebar', $data);
    		$this->load->view('template/topbar', $data);
    		$this->load->view('user/changepassword', $data);
    		$this->load->view('template/footer');
        	}
	
	
	
}