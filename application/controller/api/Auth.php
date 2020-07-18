<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
//require APPPATH . '/libraries/REST_Controller.php';

class Auth extends CI_Controller {

    public function __construct() { 
        parent::__construct();

        $check_auth_client = $this->model->check_auth_client();
        if($check_auth_client != true){
            die($this->output->get_output());
        }
    }

    public function userlogin(){
        $hash = md5(time());
        $usession = substr($hash, 0, 20);

        $method = $_SERVER['REQUEST_METHOD'];
        if($method != 'POST'){
            json_output(400,array('status' => 400,'message' => 'Bad request.'));
        }
        else {
            $check_auth_client = $this->model->check_auth_client();
            if($check_auth_client == true){
                if((empty($_POST['username'])) || (empty($_POST['password']))){
                    $respStatus = 400;
                    $resp = array('status' => 400, 'message' =>  'Provide username & password');
                }
                elseif((!empty($_POST['username'])) || (!empty($_POST['password']))) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $users = $this->Truepe_model->get_data('user',['contact'=>$username,'password'=>$password]);
                    if(!empty($users)){
                        $session = $users->user_session;
                        $respStatus = 200;
                        $resp = array('status' => 200, 'message' => 'Login Successful', 'session' => $session);
                    }else{
                        $respStatus = 404;
                        $resp = array('status' => 404, 'message' => 'Incorrect username & password');
                    }
                }
                json_output($respStatus,$resp);
            }
        }
    }

}