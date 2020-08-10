<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH. 'core/MY_RestController.php';

use \Firebase\JWT\JWT;

class Auth extends MY_RestController
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
	}

	public function login_post()
	{
		$identity = $this->input->post('username');
		$password = $this->input->post('password');

		if ($this->ion_auth->login($identity, $password, FALSE)) {
			$user = $this->ion_auth->user()->row();
			try {
				$key = $this->config->item('jwt_key');
				$payload = array(
					'id_user' => $user->id,
					'active'  => $user->active,
					'exp' => time() + 1000
				);
				$output = array(
					'status' => true, 
					'token' => JWT::encode($payload, $key)
				);
			} catch (Exception $e) {
				$output = array(
					'status' => false, 
					'data' => $e->getMessage()
				);
			}

			$this->response($output, 200);
		} else {
			$this->response(
				array(
					'status' => false, 
					'message' => 'Incorrect username or password'
				), 401);
		}
	}
}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */