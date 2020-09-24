<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}
	public function index()
	{
		$data['title'] = 'My Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}


	public function edit()
	{
		$data['title'] = 'Edit Profile';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nik', 'Nomor Induk Karyawan', 'required|trim');
		$this->form_validation->set_rules('divisi', 'Divisi', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('no_tlp', 'Nomor Telepon', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$nik = $this->input->post('nik');
			$divisi = $this->input->post('divisi');
			$nama = $this->input->post('nama');
			$no_tlp = $this->input->post('no_tlp');
			$email = $this->input->post('email');

			$this->db->set('nik', $nik);
			$this->db->set('divisi', $divisi);
			$this->db->set('nama', $nama);
			$this->db->set('no_tlp', $no_tlp);
			$this->db->where('email', $email);
			$this->db->update('user');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your Profile Has Been update! </div>');
			redirect('user');
		}
	}


	public function changePassword()
	{
		$data['title'] = 'Change Password';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if (!password_verify($current_password, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password </div>');
				redirect('user/edit');
			} else {
				if ($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New Password Cant Be the Same As Current Password </div>');
					redirect('user/edit');
				} else {
					//password sudah okee
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Change</div>');
					redirect('user/edit');
				}
			}
		}
	}
	public function pengajuan()
	{
		$data['title'] = 'Pengajuan Perbaikan';
		$emailsession =  $this->session->userdata('email');
		$data['user'] = $this->db->get_where('user', ['email' => $emailsession])->row_array();
		$data['pengajuan'] = $this->db->query("SELECT * FROM tb_pengajuan WHERE email ='$emailsession' AND status ='pengajuan' OR status = 'disetujui' OR status='Dikerjakan' ")->result_array();
		$data['selesai'] = $this->db->query("SELECT * FROM tb_pengajuan WHERE status = 'Selesai' AND email ='$emailsession'")->result_array();

		$this->form_validation->set_rules('nama_perangkat', 'Nama Perangkat', 'required');
		$this->form_validation->set_rules('uraian_masalah', 'Uraian Masalah', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/pengajuan', $data);
			$this->load->view('templates/footer');
		} else {
			$email = $this->input->post('email', true);
			$tgl_pengajuan = $this->input->post('tgl_pengajuan', true);
			$data = [
				'token' => htmlspecialchars($this->input->post('token', true)),
				'nik' => htmlspecialchars($this->input->post('nik', true)),
				'divisi' => htmlspecialchars($this->input->post('divisi', true)),
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'no_tlp' => htmlspecialchars($this->input->post('no_tlp', true)),
				'email' => htmlspecialchars($email),
				'nama_perangkat' => htmlspecialchars($this->input->post('nama_perangkat', true)),
				'uraian_masalah' => htmlspecialchars($this->input->post('uraian_masalah', true)),
				'tgl_pengajuan' => htmlspecialchars($tgl_pengajuan),
				'tgl_penyelesaian' => $this->input->post('tgl_penyelesaian', true),
				'diagnosa' => htmlspecialchars($this->input->post('diagnosa', true)),
				'uraian_penyelesaian' => htmlspecialchars($this->input->post('uraian_penyelesaian', true)),
				'nama_teknisi' => htmlspecialchars($this->input->post('nama_teknisi', true)),
				'nik_teknisi' => htmlspecialchars($this->input->post('nik_teknisi', true)),
				'status' => htmlspecialchars($this->input->post('status', true))
			];

			$this->db->insert('tb_pengajuan', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengajuan Sukses</div>');
			redirect('user/pengajuan');
		}
	}

	public function penelusuran()
	{
		$data['title'] = 'Tracking Pengajuan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['penelusuran'] = $this->db->get('tb_pengajuan')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/penelusuran', $data);
		$this->load->view('templates/footer');
	}

	public function hasil_penelusuran()
	{
		$token = $this->input->post('token');
		$data['title'] = 'Tracking Pengajuan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['penelusuran'] = $this->db->get_where('tb_pengajuan', array('token' => $token))->result();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/penelusuran1', $data);
		$this->load->view('templates/footer');
	}

	function track_pengajuan()
	{
		$token = $this->input->post('token');
		$data['penelusuran'] = $this->db->get_where('tb_pengajuan', array('token' => $token))->result();

		echo json_encode($data['penelusuran']);
	}
}
