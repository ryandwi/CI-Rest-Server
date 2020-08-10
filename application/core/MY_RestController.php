<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;
use \Firebase\JWT\JWT;

class MY_RestController extends RestController
{
	function __construct()
	{
		parent::__construct();
	}

	public function auth()
	{
		$headers = $this->input->get_request_header('Authorization');
		$key     = $this->config->item('jwt_key');
		$token	 = "";

		if (!empty($headers)) {
        	if (preg_match('/Bearer\s(\S+)/', $headers , $matches)) {
            	$token = $matches[1];
        	}
    	}

    	try {
    		$decoded = JWT::decode($token, $key, array('HS256'));
    	} catch (Exception $e) {
    		$output = array('status' => false, 'message' => $e->getMessage());
    		$this->response($output, 401);
    	}
	}
}

/* End of file MY_RestController.php */
/* Location: ./application/core/MY_RestController.php */