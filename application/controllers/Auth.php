<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH. 'core/MY_RestController.php';

class Auth extends MY_RestController
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function login_post()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		

	}
}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */