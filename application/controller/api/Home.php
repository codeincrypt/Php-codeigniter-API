<?php 
//require APPPATH . 'libraries/REST_Controller.php';
class Home extends CI_Controller {
	public function __construct() { 
		parent::__construct();

		$check_auth_client = $this->model->check_auth_client();
		if($check_auth_client != true){
			die($this->output->get_output());
		}
	}

	public function getdata($slug = NULL){
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		}
		else {
			$check_auth_client = $this->model->check_auth_client();
			if($check_auth_client == true){
				// CODE HERE
			}
		}
	}

	public function postdata($slug = NULL){
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		}
		else {
			$check_auth_client = $this->model->check_auth_client();
			if($check_auth_client == true){
				// CODE HERE
			}
		}
	}
}