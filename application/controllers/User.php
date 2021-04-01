<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model');
	}
	
    public function register()
	{
        $data['page_title'] = 'Register | Users'; 
        $this->load->view('templates/header', $data);
        $this->load->view('register');  
        $this->load->view('templates/footer');
	}
    
    public function dashboard()
	{
        $data['page_title'] = 'Dashboard | Users'; 
        $uid = $this->session->userdata('userid');
        $data['user'] = $this->User_model->getUserRecord($uid);
        $this->load->view('templates/header', $data);
        $this->load->view('dashboard', $data);  
        $this->load->view('templates/footer');
	}
    
    public function edituser()
	{
        $data['page_title'] = 'Edit User'; 
        $uid = $this->session->userdata('userid');
        $data['user'] = $this->User_model->getUserRecord($uid);
        $this->load->view('templates/header');
        $this->load->view('edituser', $data);  
        $this->load->view('templates/footer');
	}

    public function registerUser()
	{
        $this->form_validation->set_rules('inputUsername', 'Username', 'trim|required|min_length[6]|max_length[15]|is_unique[user.user_name]');
		$this->form_validation->set_rules('inputEmail', 'Email', 'trim|required|valid_email|is_unique[user.user_email]');
		$this->form_validation->set_rules('inputPassword', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('inputAge', 'Age', 'trim|numeric|required');
		$this->form_validation->set_rules('inputCity', 'City', 'trim|required');
		$this->form_validation->set_rules('inputPostcode', 'Postcode', 'trim|required');
		$this->form_validation->set_rules('inputAddress', 'Address', 'trim|required');
        $this->form_validation->set_message('is_unique', 'The %s is already taken');
        $this->form_validation->set_error_delimiters('<div class="error-msg">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
             $this->session->set_flashdata('error', validation_errors());
		}
		else
		{
			$username  = $this->security->xss_clean($this->input->post('inputUsername'));
			$email 	   = $this->security->xss_clean($this->input->post('inputEmail'));
			$password  = $this->security->xss_clean($this->input->post('inputPassword'));
			$age 	   = $this->security->xss_clean($this->input->post('inputAge'));
			$city      = $this->security->xss_clean($this->input->post('inputCity'));
			$postcode  = $this->security->xss_clean($this->input->post('inputPostcode'));
			$address   = $this->security->xss_clean($this->input->post('inputAddress'));
			
			$options = array("cost"=>4);
			$hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);
			
			$insertDataUser = array('user_name'     => $username,
    								'user_email'    => $email,
    								'user_password' => $hashPassword,
    								'age'           => $age
                                    );
			$insertDataUserAddress = array('city'      => $city,           								
            							   'post_code' => $postcode,
            							   'address'   => $address
                                          );
											
    		$insertUser = $this->User_model->insertUser($insertDataUser, $insertDataUserAddress);
    	
    		if ($insertUser)
    		{
                $this->session->set_flashdata('success', 'Congrats! You have successfully registered');
                redirect('register');
    		}
    		else
    		{
                $this->session->set_flashdata('error', 'Unable to save user. Please try again');
    		}
		}
        $this->load->view('templates/header');
        $this->load->view('register');
        $this->load->view('templates/footer');
	}

    public function processEditUser()
	{
		
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required|callback_check_duplicate_username[user_name]');
		$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|callback_check_duplicate_email[user_email]');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required');
		$this->form_validation->set_rules('age', 'Age', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim');
		$this->form_validation->set_rules('postcode', 'Postcode', 'trim');
		$this->form_validation->set_rules('address', 'Address', 'trim');

		$this->form_validation->set_message('check_duplicate_username', 'This username is already exist. Please write a new username.');
		$this->form_validation->set_message('check_duplicate_email', 'This email is already exist. Please write a new email.');
        
		if ($this->form_validation->run() == FALSE)
		{
            $errors = validation_errors();
            echo json_encode(['error'=>$errors]);
            exit;
		}
		else
		{
			$user_id   = $this->security->xss_clean($this->input->post('user_id'));
			$username  = $this->security->xss_clean($this->input->post('user_name'));
			$email 	   = $this->security->xss_clean($this->input->post('user_email'));
			$password  = $this->security->xss_clean($this->input->post('user_password'));
			$age 	   = $this->security->xss_clean($this->input->post('age'));
			$city      = $this->security->xss_clean($this->input->post('city'));
			$postcode  = $this->security->xss_clean($this->input->post('postcode'));
			$address   = $this->security->xss_clean($this->input->post('address'));
			
			$hashPassword = '';
            if ($password !== 'password') {
                $options = array("cost"=>4);
    			$hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);
            }
 
			
			$updateData = array('user_id'       => $user_id,
                                'user_name'     => $username,
								'user_email'    => $email,
								'age'           => $age
                                );
            if (!empty($hashPassword)) {
                $updateData['user_password'] = $hashPassword;
            }
			$updateDataUserAddress = array('city'      => $city,           								
            							   'post_code' => $postcode,
            							   'address'   => $address
                                          );
			
			$updateData = $this->User_model->updateUser($updateData, $updateDataUserAddress);
		
			if($updateData)
			{
                $session_data = array(  
                    'username'      => $username, 
                    'userid'        => $user_id
                );  
                $this->session->set_userdata($session_data);
                $this->session->set_flashdata('success', 'Congrats! You have successfully edited your record');
                echo 1;
			}
			else
			{
                  $this->session->set_flashdata('error', 'Unable to update your details. Please try again');
                  echo 0;
			}
		
		}
	} 
    
    public function check_duplicate_username($username)
    {
        $uid = $this->session->userdata('userid');
        return $this->User_model->checkDuplicateUsername($username, $uid);
    }    
    
    public function check_duplicate_email($post_email)
    {
        $uid = $this->session->userdata('userid');
        return $this->User_model->checkDuplicateEmail($post_email, $uid);
    }

    public function logout()
    {
        $this->session->set_userdata(array('username' => '', 'userid' => '', 'authenticated' => FALSE));
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }   
}
