<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model');
        $this->load->helper('cookie');
	}

	public function index()
	{
        $data['page_title'] = 'Login | Users';  
        $this->load->view('templates/header', $data);
        $this->load->view('login');  
        $this->load->view('templates/footer');
	}
    
    public function processLogin()
	{
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $rememberme = $this->input->post('rememberme');

        if (!isset($email) || $email == '' || $email == 'undefined') {
            echo 2;
            exit();
        }
        if (!isset($password) || $password == '' || $password == 'undefined') {
            echo 3;
            exit();
        }
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo 4;
            exit();
        } else {
            if($arr=$this->User_model->loginUser($email, $password))  
            {  
                $session_data = array(  
                    'username'      => $arr['user_name'], 
                    'userid'        => $arr['user_id'],
                    'authenticated' => TRUE
                );  
                $this->session->set_userdata($session_data);
                // remember me
                if(!empty($rememberme)) { 
                    set_cookie(array('name' => 'loginId', 'value' => $email, 'expire' => time()+ (10 * 365 * 24 * 60 * 60) ));
                    set_cookie(array('name' => 'loginPass', 'value' => $password, 'expire' => time()+ (10 * 365 * 24 * 60 * 60) ));
                } else {
                  setcookie (array('name' => 'loginId', 'value'  => '')); 
                  setcookie (array('name' => 'loginPass', 'value'  => '')); 
                }           
                echo 1;
                exit();
            }  
            echo 4;
            exit;
        }
	}
}
