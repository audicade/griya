<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Property extends CI_Controller {

	public function __construct(){
		
		parent::__construct();
		is_logged_in();	
		
	}
	
	
	public function index(){
		
		
		$data['title'] = 'Pasar';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['user_property'] = $this->db->get_where('user_property', ['email' => $this->session->userdata('email')])->row_array();
		
		
		$email = $this->session->userdata('email');
		$nani = $this->db->get_where('user_property', ['is_active' => 1])->row_array();

			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('property/index', $data);
			$this->load->view('template/footer');		
		
		
	}

	// public function selectImage(){
	// 	$this->load->model('Property');
	// 	$id = $this->input->post();

 //    	$data = $this->Property->getImage($id);

	// json_encode($data);
	// }

	public function updateIsActive(){
		$id = $this->input->post('id');
		$lidi = $this->session->userdata('id');
		$email = $this->session->userdata('email');
        $emailP = $this->input->post('email');

        if($email == $emailP){
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Maaf anda tidak dapat menyewa properti anda sendiri!!</div>');
		redirect('property');    
        } else{

		$this->db->set('is_active', 0);
		$this->db->where('id', $id);
		$this->db->update('user_property');

		$this->db->set('property_id', $lidi);
		$this->db->where('id', $id);
		$this->db->update('user_property');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Selamat!! Anda telah menyewa properti.</div>');
		redirect('property');

        }
	}

		public function updateIs(){
		$id = $this->input->post('id');

		$this->db->set('is_active', 1);
		$this->db->where('id', $id);
		$this->db->update('user_property');

		
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Anda telah meninggalkan properti.</div>');
		redirect('property');

	}		
	

		public function upload(){
		
		$data['title'] = 'Unggah Properti';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['user_property'] = $this->db->get_where('user_property', ['email' => $this->session->userdata('email')])->row_array();
		$dota = $this->db->get_where('user_property', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->form_validation->set_rules('location', 'Location', 'required|trim');
		$this->form_validation->set_rules('number', 'Number', 'required|trim');
		$this->form_validation->set_rules('price', 'Price', 'required|trim');
		$this->form_validation->set_rules('spec', 'Specification', 'required|trim');
		
		
		if($this->form_validation->run() == false){
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('property/upload', $data);
			$this->load->view('template/footer');	
		} else {
			
			// upload gambar
			$upload_image = $_FILES['image']['name'];
			
			if($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']		 = '2048';
				$config['upload_path']	 = './assets/img/property/';
				
				$this->load->library('upload', $config);
				
				if($this->upload->do_upload('image')){
					$old_image = $data['user_property']['image'];
					
					//hapus gambar lama
					//if($old_image != 'default.jpg'){
					//	unlink(FCPATH . 'assets/img/property/' . $old_image);
					//}

//tempat baru update database

                $new_image = $this->upload->data('file_name');
                $id = $this->session->userdata('id');
			
			$upload = [
				'email' => htmlspecialchars($this->input->post('email', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'image' => $new_image,
				'location' => htmlspecialchars($this->input->post('location', true)),
				'number' => htmlspecialchars($this->input->post('number', true)),
				'price' => htmlspecialchars($this->input->post('price', true)),
				'spec' => htmlspecialchars($this->input->post('spec', true)),
				'property_id' => $id,
				'is_active' => 1,
				'date_created' => time()
				
			];
			
			$this->db->insert('user_property', $upload);

				
				} else {
					echo $this->upload->display_errors();
				}
				
			}
// tempat lama update database
// 			$id = $this->session->userdata('id');
			
// 			$upload = [
// 				'email' => htmlspecialchars($this->input->post('email', true)),
// 				'username' => htmlspecialchars($this->input->post('username', true)),
// 				'image' => $new_image,
// 				'location' => htmlspecialchars($this->input->post('location', true)),
// 				'number' => htmlspecialchars($this->input->post('number', true)),
// 				'price' => htmlspecialchars($this->input->post('price', true)),
// 				'spec' => htmlspecialchars($this->input->post('spec', true)),
// 				'property_id' => $id,
// 				'is_active' => 1,
// 				'date_created' => time()
				
// 			];
			
// 			$this->db->insert('user_property', $upload);
			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Your Property Has Been Uploaded</div>');
			redirect('property');
			
		}
		
		
		
	}
	
	
	public function editpro(){
		
		$data['title'] = 'Ubah Properti';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['user_property'] = $this->db->get_where('user_property', ['email' => $this->session->userdata('email')])->row_array();
		$dota = $this->db->get_where('user_property', ['email' => $this->session->userdata('email')])->row_array();
		
		$this->form_validation->set_rules('location', 'Location', 'required|trim');
		$this->form_validation->set_rules('number', 'Number', 'required|trim');
		$this->form_validation->set_rules('price', 'Price', 'required|trim');
		$this->form_validation->set_rules('spec', 'Specification', 'required|trim');
		
		
		if($this->form_validation->run() == false){
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('property/editpro', $data);
			$this->load->view('template/footer');	
		} else {
			
			// upload gambar
			$upload_image = $_FILES['image']['name'];
			
			if($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']		 = '2048';
				$config['upload_path']	 = './assets/img/property/';
				
				$this->load->library('upload', $config);
				
				if($this->upload->do_upload('image')){
					$old_image = $data['user_property']['image'];
					
					//hapus gambar lama
					if($old_image != 'default.jpg'){
						unlink(FCPATH . 'assets/img/property/' . $old_image);
					}
					
					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
				
			}
			
			$location = $this->input->post('location');
			$id = $this->input->post('id');
			$number = $this->input->post('number');
			$price = $this->input->post('price');
			$spec = $this->input->post('spec');
			
			$this->db->set('location', $location);
			$this->db->where('id', $id);
			$this->db->update('user_property');
			
			$this->db->set('number', $number);
			$this->db->where('id', $id);
			$this->db->update('user_property');

			$this->db->set('price', $price);
			$this->db->where('id', $id);
			$this->db->update('user_property');
			
			$this->db->set('spec', $spec);
			$this->db->where('id', $id);
			$this->db->update('user_property');
			
			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Properti anda telah diperbaharui</div>');
			redirect('property');
			
		}
		
		
		
	}

	
	public function mypro(){
		
		$data['spasi'] = ' ';
		$data['title'] = 'Data Properti';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['user_property'] = $this->db->get_where('user_property', ['email' => $this->session->userdata('email')])->row_array();
		
		
		$email = $this->session->userdata('email');
		$nani = $this->db->get_where('user_property', ['is_active' => 1])->row_array();
				
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('property/mypro', $data);
			$this->load->view('template/footer');

		
		
		
	}
	
	
	public function delete(){
		
		
		$data['title'] = 'Hapus Properti';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['user_property'] = $this->db->get_where('user_property', ['email' => $this->session->userdata('email')])->row_array();
			
	//	$this->form_validation->set_rules('pilihan', 'Option', 'required');

	//	if($this->form_validation->run() == false){
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('property/delete', $data);
			$this->load->view('template/footer');

	//	} else{
			$id = $this->input->post('id');
			$sql = " DELETE FROM `user_property` WHERE `id` = '$id' ";
			
			$this->db->query($sql);
//			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Your property has been deleted</div>');	
// 			redirect(property);
	
//		}
			
			
							
}	
	
	public function back(){
		
		$data['spasi'] = ' ';
		$data['title'] = 'Data Properti';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['user_property'] = $this->db->get_where('user_property', ['email' => $this->session->userdata('email')])->row_array();
		
		
		$email = $this->session->userdata('email');
		$nani = $this->db->get_where('user_property', ['is_active' => 1])->row_array();
				
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('property/mypro', $data);
			$this->load->view('template/footer');

		
		
		
	}
	
	
	public function cari(){
		$cari = $this->input->post('cari');
		$data['cari'] = $cari;
		$data['title'] = 'Pasar';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['user_property'] = $this->db->get_where('user_property', ['email' => $this->session->userdata('email')])->row_array();
		
		
		$email = $this->session->userdata('email');
		$nani = $this->db->get_where('user_property', ['is_active' => 1])->row_array();

			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/topbar', $data);
			$this->load->view('property/cari', $data);
			$this->load->view('template/footer');		
		
		
	}
	
	
	
	
	
}