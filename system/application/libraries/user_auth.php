<?php

Class User_auth {
	protected $error_start_delimiter;
	protected $error_end_delimiter;
	private $ci;
	function User_auth() {
		$this->ci = &get_instance();
		$this->ci->load->model('users_model');
		$this->ci->load->config('ion_auth', TRUE);
		$this->ci->lang->load('ion_auth');
		$this->ci->load->model('ion_auth_model');
		$this->ci->load->library('email');
		$this->ci->load->library('session');
		$this->ci->load->helper('cookie');
	}

	/**
    *
    * Function to login
    * @author : Rabeesh
    * @param  : []
    * @return : type : [Array()]
    *
    **/
 	 function login($username, $password, $remember_me=false) {
		$data['username']=$username;
		$data['password']=$password;
		$status = $this->ci->users_model->login($data);
		
		if($status) {
			$this->ci->session->set_userdata('id', $status['id']);
			$this->ci->session->set_userdata('email', $status['email']);
			$this->ci->session->set_userdata('name', $status['name']);
			$this->ci->session->set_userdata('city_id', $status['city_id']);
			$this->ci->session->set_userdata('type', $status['type']);
			
			//$this->ci->session->set_userdata('permissions', $status['permissions']);
			//$this->ci->session->set_userdata('groups', $status['groups']);
			
			if($remember_me) {
				setcookie('email', $status['email'], time() + 3600 * 24 * 30, '/'); // Expires in a month.
				setcookie('password_hash', md5($password . '2o^6uU!'), time() + 3600 * 24 * 30, '/');
			}
		}
		
		return $status;
	}
	
    /**
    * Function to logged_in
    * @author : Rabeesh
    * @param  : []
    * @return : type : [Boolean]
    *
    **/    
	function logged_in() {
		if ( $this->ci->session->userdata('id') ) {
			return $this->ci->session->userdata('id');
		
		} elseif(get_cookie('email') and get_cookie('password_hash')) {
			//This is a User who have enabled the 'Remember me' Option - so there is a cookie in the users system
			$email = get_cookie('email');
			$password_hash = get_cookie('password_hash');
			$user_details = $this->ci->users_model->db->query("SELECT email,password FROM user 
				WHERE email='$email' AND MD5(CONCAT(password,'2o^6uU!'))='$password_hash'")->row();
			
			if($user_details) {
				$status = $this->login($user_details->email, $user_details->password);
				return $status['id'];
			}
		}
		return false;
	}
	
	/**
    *
    * Function to getUser
    * @author : Rabeesh
    * @param  : []
    * @return : type : [Boolean]
    *
    **/
    function getUser() {
		$user_id = $this->logged_in();
		if($user_id) return $this->ci->user_model->get_user($user_id);
		return false;
	}
	
	/**
    * Function to logout
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	function logout () {
		delete_cookie('email');
		delete_cookie('password_hash');
		
		return $this->ci->session->unset_userdata('id');
	}
	
	/// Check to see if the user has permission to do the given activity. Redirect to the no-permissions page if he don't.
	function check_permission($permission_name) {
		if($this->get_permission($permission_name)) return true;
		
		redirect('auth/no_permission');
	}
	
	/// Returns true if the current user has permission to do the action specified in the argument
	function get_permission($permission_name) {
		if($this->ci->session->userdata('id') == 1) return true; //:UGLY:
		
		return in_array($permission_name, $this->ci->session->userdata('permissions'));
	}
	
	/**
    * Function to forgotten_password
    * @author : Rabeesh
    * @param  : []
    * @return : type : []
    *
    **/
	public function forgotten_password($identity)    
	{
		$this->ci->load->model('users_model');
		$users = $this->ci->users_model->search_users(array('email'=>$identity));
		if($users) {
			$user = reset($users);
			$password_message = <<<END
Hey {$user->name},

Stockerboy password reminder...
Username: {$user->email}
Password: {$user->password}
Login At: http://makeadiff.in/madapp/

Thanks.
--
MADApp
END;

			$this->ci->email->to($user->email);
			$this->ci->email->subject('Stockerboy Password Reminder');
			$this->ci->email->message($password_message);
			$this->ci->email->send();
		}
		return true;
	}
}


