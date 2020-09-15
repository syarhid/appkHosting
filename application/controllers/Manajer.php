<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajer extends CI_Controller{
	public function __construct()
	{
	parent::__construct();
	$this->load->library('form_validation');

	}



	public function index()
	{
		$data['title'] = 'My Profile';

		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('manajer/index', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
{
	$data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nik','Nomor Induk Karyawan','required|trim');
		$this->form_validation->set_rules('divisi','Divisi','required|trim');
		$this->form_validation->set_rules('nama','Nama Lengkap','required|trim');
		$this->form_validation->set_rules('no_tlp','Nomor Telepon','required|trim');

		if($this->form_validation->run() == false){
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('manajer/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$nik = $this->input->post('nik');
			$divisi = $this->input->post('divisi');
			$nama = $this->input->post('nama');
			$no_tlp = $this->input->post('no_tlp');
			$email = $this->input->post('email');

			$this->db->set('nik',$nik);
			$this->db->set('divisi',$divisi);
			$this->db->set('nama',$nama);
			$this->db->set('no_tlp',$no_tlp);
			$this->db->where('email',$email);
			$this->db->update('user');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Your Profile Has Been update! </div>');
			redirect('manajer');

		}
		
	}
	public function changePassword(){
	$data['title'] = 'Change Password';
	$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();

	$this->form_validation->set_rules('current_password','Current Password','required|trim');
	$this->form_validation->set_rules('new_password1','New Password','required|trim|min_length[3]|matches[new_password2]');
	$this->form_validation->set_rules('new_password2','Confirm New Password','required|trim|min_length[3]|matches[new_password1]');

	if($this->form_validation->run() == false){
		$this->load->view('templates/header',$data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/topbar',$data);
		$this->load->view('manajer/changepassword',$data);
		$this->load->view('templates/footer');
	} else{
		$current_password = $this->input->post('current_password');
		$new_password = $this->input->post('new_password1');
		if(!password_verify($current_password, $data['user']['password'])){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong current password </div>');
			redirect('manajer/changepassword');
		} else{
			if($current_password == $new_password){
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">New Password Cant Be the Same As Current Password </div>');
			redirect('manajer/changepassword');
			} else{
				//password sudah okee
				$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

				$this->db->set('password' , $password_hash);
				$this->db->where('email', $this->session->userdata('email'));
				$this->db->update('user');

				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password Change</div>');
			redirect('manajer/changepassword');
			}
		}
	}
}

public function pengajuan()
{
		
		$data['title'] = "Request Persetujuan";
		$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
		$data['pengajuan'] = $this->db->get_where('tb_pengajuan', ['status' => 'pengajuan'])->result_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('manajer/pengajuan', $data);
		$this->load->view('templates/footer');
}
public function approve(){
	$token = $this->uri->segment(3);
	$this->db->set('status', 'disetujui');
	$this->db->where('token', $token);
	 $this->db->update('tb_pengajuan');
	 redirect('Manajer/pengajuan', 'refresh');
}

public function ditolak(){
	$token = $this->uri->segment(3);
	$this->db->set('status', 'ditolak');
	$this->db->where('token', $token);
	 $this->db->update('tb_pengajuan');
	 redirect('Manajer/pengajuan', 'refresh');
}


public function reporting()
{
	$data['title'] = 'Laporan Data Pengajuan';

	$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
	$this->db->where('status' , 'Dikerjakan');
	$this->db->or_where('status' , 'Selesai');
	$this->db->or_where('status' , 'disetujui');
	$this->db->or_where('status' , 'ditolak');
	$data['laporan'] = $this->db->get('tb_pengajuan')->result_array();
	

	$this->load->view('templates/header', $data);
	$this->load->view('templates/sidebar', $data);
	$this->load->view('templates/topbar', $data);
	$this->load->view('manajer/reporting', $data);
	$this->load->view('templates/footer');
}
}