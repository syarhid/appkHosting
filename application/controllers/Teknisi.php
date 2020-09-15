<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Teknisi extends CI_Controller{
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
		$this->load->view('teknisi/index', $data);
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
			$this->load->view('teknisi/edit', $data);
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
			redirect('teknisi');

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
		$this->load->view('teknisi/changepassword',$data);
		$this->load->view('templates/footer');
	} else{
		$current_password = $this->input->post('current_password');
		$new_password = $this->input->post('new_password1');
		if(!password_verify($current_password, $data['user']['password'])){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong current password </div>');
			redirect('teknisi/changepassword');
		} else{
			if($current_password == $new_password){
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">New Password Cant Be the Same As Current Password </div>');
			redirect('teknisi/changepassword');
			} else{
				//password sudah okee
				$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

				$this->db->set('password' , $password_hash);
				$this->db->where('email', $this->session->userdata('email'));
				$this->db->update('user');

				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password Change</div>');
			redirect('teknisi/changepassword');
			}
		}
	}
}

public function perbaikan()
{
	$data['title'] = 'Tugas Perbaikan';

	$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
	$this->db->where('status', 'disetujui');
	$this->db->or_where('status', 'Dikerjakan');
	$data['perbaikan'] = $this->db->get_where('tb_pengajuan')->result_array();

	$this->load->view('templates/header', $data);
	$this->load->view('templates/sidebar', $data);
	$this->load->view('templates/topbar', $data);
	$this->load->view('teknisi/perbaikan', $data);
	$this->load->view('templates/footer');
}
public function approve(){
	$token = $this->uri->segment(3);
	$checkstatus = $this->db->query("SELECT status FROM tb_pengajuan WHERE token='$token'")->result();

	foreach($checkstatus as $row){
		$hasil = $row->status;
	}
	if($hasil  == "disetujui"){
		$this->db->set('status' , 'Dikerjakan');
		$this->db->set('nama_teknisi' , $this->session->userdata('nama'));
		$this->db->where('token' , $token);
		$this->db->update('tb_pengajuan');
		redirect('teknisi/perbaikan');
	} else {
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Laporan sudah ditangani oleh teknisi lain</div>');
		redirect('teknisi/perbaikan');
	}
	
}
 public function diagnosa(){
	$data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
	$data['tugas'] = $this->db->get_where('tb_pengajuan',['token' => $this->session->userdata('token')])->row_array();
	$this->form_validation->set_rules('diagnosa','diagnosa','required|trim');
		$this->form_validation->set_rules('uraian_penyelesaian','penyelesaian','required|trim');

		if($this->form_validation->run() == false){
			redirect('teknisi/perbaikan');
			// Test
		} else {
			$tgl_penyelesaian = $this->input->post('tgl_penyelesaian');
			$diagnosa = $this->input->post('diagnosa');
			$uraian_penyelesaian = $this->input->post('uraian_penyelesaian');
			$nama_divisi = $this->input->post('nama_divisi');
			$nik_teknisi = $this->input->post('nik_teknisi');
			$status = $this->input->post('status');
			$token = $this->input->post('token_diagnosa');

			$this->db->set('tgl_penyelesaian',$tgl_penyelesaian);
			$this->db->set('diagnosa',$diagnosa);
			$this->db->set('uraian_penyelesaian',$uraian_penyelesaian);
			$this->db->set('nama_teknisi',$nama_divisi);
			$this->db->set('nik_teknisi',$nik_teknisi);
			$this->db->set('status',$status);
			$this->db->where('token',$token);

			$this->db->update('tb_pengajuan');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data Telah Tersimpan </div>');
			redirect('teknisi/perbaikan');
		}
			
}

}