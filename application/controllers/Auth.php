<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		
		
		
	}
	
	
	public function index()
	{
		
		if($this->session->userdata('email')) {
			redirect('user');
				}
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run() == false){

		$data['title'] = 'login pane';
		$this->load->view('template/auth_header', $data);
		$this->load->view('auth/login');
		$this->load->view('template/auth_footer');	
		
		} else {
			
			$this->_login();
			
		}
		
	}
	
	private function _login(){
		
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		
		// jika user ada
		if($user) {
			// jika user aktif
			if($user['is_active'] == 1){
				// cek password
				if(password_verify($password, $user['password'])){
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id'],
						'id' => $user['id'],
						'username' => $user['username']
					];
					$this->session->set_userdata('id', $user['id']);
					$this->session->set_userdata($data);
					// cek role
					if($user['role_id'] == 1){
						redirect('admin');
					} else {
						redirect('property');
						}
				
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email atau Password salah!</div>');
					redirect('auth');	
				}
				
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email belum diaktifkan!</div>');
				redirect('auth');	
			}
		} else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email tidak terdaftar!</div>');
			redirect('auth');
			
		}
		
	}
	
	public function registration()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
				}
		
		
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'This email has already registered!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|matches[password2]', 
				[
					'matches' => 'Password does not match!',
					'min_length' => 'Password too short!'
				]);
		$this->form_validation->set_rules('password2', 'Password2', 'required|trim|matches[password]');
		
		if	($this->form_validation->run() == false)
		{
			$data['title'] = 'Griya User Registration';
			$this->load->view('template/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('template/auth_footer');
		} else{
			$email = $this->input->post('email', true);
			$data = [
				'username' => htmlspecialchars($this->input->post('username', true)),
				'email' => htmlspecialchars($email),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				'role_id' => 2,
				//dibuat jadi 1 dulu, token belom berfungsi
				'is_active' => 1,
				'date_created' => time()
				
			];

			//token belom sempurna
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $email,
				'token' => $token

			];
			
			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);
			
			$this->_sendEmail($token, 'verify');
			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Selamat! Akun anda berhasil dibuat. silahkan aktivasi email!</div>');
			redirect('auth');
		}
	}
	
	// kirim email
	private function _sendEmail($token, $type){
		
		$config = [
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'griyaa.id@gmail.com',
			'smtp_pass' => 'Griyahci4',
			'smtp_port' => 465,
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
		];
		
		$this->load->library('email',$config);  
		$this->email->initialize($config); 
		$this->email->from('griyaa.id@gmail.com', 'Griya.id team');
		$this->email->to($this->input->post('email'));
		
		if($type == 'verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Click this link to verify your account : <a href="'. base_url() .'auth/verify?email=' . $this->input->post('email') .'&token=' . urlencode($token) . '">Activate</a>');
	
			
		} else if($type == 'forgot'){
			$this->email->subject('Reset Password');
			$this->email->message('Click this link to reset your password : <a href="'. base_url() .'auth/resetpassword?email=' . $this->input->post('email') .'&token=' . urlencode($token) . '">Reset Password</a>');
			
			
		}
				
		if($this->email->send()){
				return true;
			} else{
//				echo $this->email->printing_debugger();
//				die;
			}
		
		
	}
	
	
	public function verify(){
		
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		
		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if ($user_token) {
				$this->db->set('is_active', 1);
				$this->db->where('email', $email);
				$this->db->update('user');
				
				$this->db->delete('user_token', ['email' => $email]);
				
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">'. $email .' Telah diaktifkan. Silahkan masuk.</div>');
				redirect('auth');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Aktivasi akun gagal!! Token salah</div>');
				redirect('auth');
	
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Aktivasi akun gagal!! Email salah</div>');
			redirect('auth');
		}
		
		
		
	}
	
	
	
	
	
	public function logout(){
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah keluar</div>');
		redirect('auth');
	}
	
	
	public function blocked(){
		
		$this->load->view('auth/blocked');
		
	}
	
	
	public function forgotPassword(){
		
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if($this->form_validation->run() == false){
			$data['title'] = 'Forgot Passwprd';
			$this->load->view('template/auth_header', $data);
			$this->load->view('auth/forgot-password');
			$this->load->view('template/auth_footer');
			
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
			
			
			
			if($user){
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token
				];
				
				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');
				
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tolong cek email anda untuk mereset password </div>');
				redirect('auth/forgotpassword');
				
			}else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email tidak terdaftar</div>');
				redirect('auth/forgotpassword');
			
			}
			
		}
		
		
	}
	
	
	public function resetPassword(){
		
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		
		
		if($user) {
			
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			
			if($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
				
			} else {
				
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Reset password gagal! Token salah</div>');
			redirect('auth');	
			}
		} else {
			
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Reset password gagal! Email salah</div>');
			redirect('auth');
		}
		
		
		
		
		
		
		
	}
	
	
	
	public function changePassword(){
		
		if(!$this->session->userdata('reset_email')){
			redirect('auth');
		}
		
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[8]|matches[password]');
		
		if($this->form_validation->run() == false){
		
		$data['title'] = 'Change Password';
		$this->load->view('template/auth_header', $data);
		$this->load->view('auth/change-password');
		$this->load->view('template/auth_footer');	
		} else {
			
			$password = password_hash($this->input->post('password', PASSWORD_DEFAULT));
			$email = $this->session->userdata('reset_email');
			
			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');
			
			$this->session->unset_userdata('reset_email');
			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password telah diubah! Silahkan masuk.</div>');
			redirect('auth');
		}

		
		
	}
	
	
		
	
	
	
}