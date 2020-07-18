<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    var $client_service = "frontend-client";
    var $auth_key = "YOUR_AUTH_KEY";

    public function check_auth_client(){
        $this->db->where('user_id', '1');
        $query = $this->db->get('keys');
        foreach($query->result() as $row){
            $auth_key = $row->key;
        }

        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            return json_output(401,array('status' => 401,'message' => 'Invalid Auth credentials.'));
        } else {
            if($_SERVER['PHP_AUTH_USER'] == 'YOUR_USERNAME' && $_SERVER['PHP_AUTH_PW'] == 'YOUR_PASSWORD'){
                $client_service = $this->input->get_request_header('Client-Service', TRUE);
                $auth_key_type  = $this->input->get_request_header('Auth-Key', TRUE);
                
                if($client_service == $this->client_service && $auth_key_type == $this->auth_key){
                    return true;
                } else {
                    return json_output(401,array('status' => 401,'message' => 'Unauthorized or Invalid API key.'));
                }
            }
            else {
                return json_output(401,array('status' => 401,'message' => 'Invalid Authentication credentials.'));
            }
        }        
    }
}