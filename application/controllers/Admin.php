<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	// public function __construct()
	// {
	// 	parent::__construct();
	// 	is_logged_in();
	// }

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	public function role()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get('user_role')->result_array();
		

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role', $data);
		$this->load->view('templates/footer');
	}

	function role_tambah()
	{
		$role['role'] = $this->input->post('role');
		$this->db->insert('user_role', $role);
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get('user_role')->result_array();
		$this->form_validation->set_rules('role', 'Role Id', 'required|trim');
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role', $data);
		$this->load->view('templates/footer');
	}
	function deleteaccess($id)
	{
		$this->db->delete('user_role', ['id' => $id]);
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['role'] = $this->db->get('user_role')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role', $data);
		$this->load->view('templates/footer');
	}

	public function roleAccess($role_id)
	{
		$data['title'] = 'Role Access';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();


		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
	}

	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);


		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
	}

	public function daftar()
	{
		$data['title'] = 'Daftar User';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['daftar'] = $this->db->get('user')->result_array();

		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('divisi', 'Divisi', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [

			'is_unique' => 'This email has already registered'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', [
			'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('role_id', 'Role Id', 'required');
		$this->form_validation->set_rules('is_active', 'Status', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/daftar', $data);
			$this->load->view('templates/footer');
		} else {
			$email = $this->input->post('email', true);
			$data = [
				'nik' => htmlspecialchars($this->input->post('nik', true)),
				'divisi' => htmlspecialchars($this->input->post('divisi', true)),
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'no_tlp' => htmlspecialchars($this->input->post('no_tlp', true)),
				'email' => htmlspecialchars($email),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id' => htmlspecialchars($this->input->post('role_id', true)),
				'is_active' => htmlspecialchars($this->input->post('is_active', true)),
				'date_created' => time()
			];

			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New User Added</div>');
			redirect('admin/daftar');
		}
	}

	function edit_user()
	{
		$data['title'] = 'Daftar User';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['daftar'] = $this->db->get('user')->result_array();

		$set = $this->input->post('nik_lama');
		$email = $this->input->post('email1', true);
		$data = [
			'nik' => htmlspecialchars($this->input->post('nik1', true)),
			'divisi' => htmlspecialchars($this->input->post('divisi1', true)),
			'nama' => htmlspecialchars($this->input->post('nama1', true)),
			'email' => htmlspecialchars($email),
			'role_id' => htmlspecialchars($this->input->post('role_id1', true)),
			'is_active' => htmlspecialchars($this->input->post('is_active1', true)),
		];

		$this->db->update('user', $data, ['nik' => $set]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User Data has been Edited</div>');
		redirect('admin/daftar');
	}

	function delete_user($nik)
	{
		$data['title'] = 'Daftar User';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['daftar'] = $this->db->get('user')->result_array();
		$this->db->delete('user', ['nik' => $nik]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User Data has been Deleted</div>');
		redirect('admin/daftar');
	}
}
