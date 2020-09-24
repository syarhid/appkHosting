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
		if($this->session->userdata('email')){
		redirect('user');
	} 
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
		$this->form_validation->set_rules('password','Password','trim|required');

		if($this->form_validation->run()== false){
			$data['title'] = 'Log In Page';
			$data['alluser'] = $this->db->get('user')->row_array();
			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else{
			//validasinya lolos atau success
			$this->_login();
		}
		
	}

	private function _login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		$user = $this->db->get_where('user',['email' => $email])->row_array();
//usernya ada
		if($user){
			//aktif
			if($user['is_active'] == 1){
				//cek password
				if(password_verify($password, $user['password'])){
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id'],
						'nama' => $user['nama']
					];

					$this->session->set_userdata($data);
					if($user['role_id'] == 1){
						redirect('admin');
					}elseif($user['role_id'] == 2){
						redirect('user');
					}elseif ($user['role_id']==3) {
						redirect('manajer');
					}elseif ($user['role_id']==4)  {
						redirect('teknisi');
					}
					
				}else{
						$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Wrong password
				</div>');
			redirect('auth');
				}

			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Email has not been activated
				</div>');
			redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> Email is not registered
				</div>');
			redirect('auth');
		}
	}

	public function registration()
	{
		if($this->session->userdata('email')){
		redirect('user');
	}
		
		$this->form_validation->set_rules('nik','Nik','required|trim');
		$this->form_validation->set_rules('divisi','Divisi','required|trim');
		$this->form_validation->set_rules('nama','Nama','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[user.email]',[

			'is_unique' => 'This email has already registered'
		]);
		$this->form_validation->set_rules('password1','Password','required|trim|min_length[3]|matches[password2]',[
			'matches' => 'Password dont matches!',
			'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('password2','Password','required|trim|matches[password1]');


		if ($this->form_validation->run() == false){
			$data['title'] = 'User Registration';
			$this->load->view('templates/auth_header',$data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else{
			$email = $this->input->post('email',true);
			$data = [
				'nik' => htmlspecialchars($this->input->post('nik',true)),
				'divisi' => htmlspecialchars($this->input->post('divisi',true)),
				'nama' => htmlspecialchars($this->input->post('nama',true)),
				'no_tlp' => htmlspecialchars($this->input->post('no_tlp',true)),
				'email' => htmlspecialchars($email),
				'password' => password_hash($this->input->post('password1'),PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 0,
				'date_created' => time()
			];


			//siapkan token yang berupa bilangan random
			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
				];


			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);

			$this->_sendEmail($token, 'verify');

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> Congratulation Your Account Has Been Created! Please Activated Your Account
				</div>');
			redirect('auth');

		}
		
	}

	private function _sendEmail($token, $type){
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'itindonesian.aerospae@gmail.com',
			'smtp_pass' => 'devikinal',
			'smtp_port' => 465,
			'mailtype'  => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->email->initialize($config);


		$this->email->from('itindonesian.aerospae@gmail.com', 'IT Center 2020');
		$this->email->to($this->input->post('email'));

		if($type == 'verify'){
			$this->email->subject('Account Verification');
			$this->email->message('Click this link to verify your account: <a href="'. base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Activate </a>');
		} else if ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Click this link to reset password: <a href="'. base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Reset Password </a>');
		}

			


		if($this->email->send()){
			return true;
		}else{
			echo $this->email->print_debugger();
			die;
		}
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if($user){
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if($user_token){
				if(time() - $user_token['date_created'] < (60*60*24)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');

					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">'. $email .' Has been activated! Please Log In.</div>');
					redirect('auth');
				}else {
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
					Account activation failed! Token expired</div>');
					redirect('auth');	
				}
			} else {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
				Account activation failed! Wrong token</div>');
				redirect('auth');
			}


		} else {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
				Account activation failed! Wrong Email</div>');
			redirect('auth');
		}
	}


	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert"> You have been log out
				</div>');
			redirect('auth');
	}


	public function blocked()
	{
		$this->load->view('auth/blocked');
	}


	public function forgotPassword()
	{

			$this->form_validation->set_rules('email','Email','trim|required|valid_email');

			if($this->form_validation->run() == false){
				$data['title'] = 'Forgot Password';
				$this->load->view('templates/auth_header',$data);
				$this->load->view('auth/forgot-password');
				$this->load->view('templates/auth_footer');	
			} else{
				$email = $this->input->post('email');
				$user = $this->db->get_where('user',['email' => $email, 'is_active' => 1])->row_array();

				if($user){
					$token = base64_encode(random_bytes(32));
					$user_token = [
						'email' => $email,
						'token' => $token,
						'date_created' => time()
					];
					$this->db->insert('user_token', $user_token);
					$this->_sendEmail($token, 'forgot');
					$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Please check your email to reset your password </div>');
				redirect('auth/forgotpassword');

				}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email is not registered or activated
				</div>');
				redirect('auth/forgotpassword');
				}
			}
			
	}


	public function resetPassword(){
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user',['email' => $email])->row_array();

		if($user){
			$user_token = $this->db->get_where('user_token',['token' => $token])->row_array();
			if($user_token){
				$this->session->set_userdata('reset_email',$email);
				$this->changePassword();
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset password failed! Wrong token!
				</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Reset password failed! Wrong email
				</div>');
				redirect('auth');
		}
	}

	public function changePassword()
	{
		if(!$this->session->userdata('reset_email')){
			redirect('auth');
		}
		$this->form_validation->set_rules('password1', 'Password','trim|required|min_length[3]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Password','trim|required|min_length[3]|matches[password1]');	
		if($this->form_validation->run() == false){
			$data['title'] = 'Change Password';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/change-password');
			$this->load->view('templates/auth_footer');
		} else{
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email= $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password has been changed! Please Log In
				</div>');
				redirect('auth');
		}
		
	}
}