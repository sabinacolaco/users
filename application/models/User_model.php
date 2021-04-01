<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
    
   /**
   * Checks for duplicate username in the user table
   *
   * @param string $uname - username
   * @param int $id - userid
   * @return bool
   */
	function checkDuplicateUsername($uname, $id)
	{
		$this->db->select('user_name');
		$this->db->from('user');
        $this->db->where("user_id <> $id");
		$this->db->like('user_name', $uname);
		$count_row = $this->db->count_all_results();
        
        if ($count_row > 0) {
            return FALSE;
        } else {
            return TRUE;
        }        
	}

   /**
   * Checks for duplicate email address in the user table
   *
   * @param string $email - email
   * @param int $id - userid
   * @return bool
   */
	function checkDuplicateEmail($email, $id)
	{
		$this->db->select('user_email');
		$this->db->from('user');
        $this->db->where("user_id <> $id");
		$this->db->like('user_email', $email);
		$count_row = $this->db->count_all_results();
        
        if ($count_row > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
	}
	
   /**
   * Inserts data in the user and user_address table
   *
   * @param array $data_user
   * @param array $data_address
   * @return bool
   */
	function insertUser($data_user, $data_address)
	{
        $data_user['registration_date'] =  date('Y-m-d H:i:s');

        $this->db->set($data_user);
        $this->db->insert('user', $data_user);
    
        $data_address['user_id'] = $this->db->insert_id();
        $this->db->set($data_address);
    
        if ($this->db->insert('user_address', $data_address))
            return $data_address['user_id'];
        else
            return false;    
	}

   /**
   * Login into the system
   *
   * @param array $email
   * @param array $password
   * @return bool
   */
    function loginUser($email, $password)  
    {      
        $this->db->where('user_email', $email);
        $this->db->limit(1);
        $query = $this->db->get('user');
        
        if ($query->num_rows() == 1) {
            $record = $query->row_array();
            if(password_verify($password, $record['user_password'])) {
                return $record;
            }else{
                return false;
            }
        } else {
            return false;
        }
    } 

   /**
   * Gets the user record from the usertable
   *
   * @param array $userid
   * @return array $record
   */
    function getUserRecord($userid)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_address', 'user.user_id = user_address.user_id');
        $this->db->where('user.user_id', $userid);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $record = $query->row_array();        
            return $record;
        }    
    }

   /**
   * Updates the user record
   *
   * @param array $data_user
   * @param array $data_address
   * @return bool
   */
    function updateUser($data_user, $data_address)
    {
        extract($data_user);
        
        $this->db->set($data_user);
        $this->db->where('user_id', $user_id);
        $this->db->update('user');
        
        $this->db->set($data_address);
        $this->db->where('user_id', $user_id);
        $this->db->update('user_address');

        return true;
    }
}	

