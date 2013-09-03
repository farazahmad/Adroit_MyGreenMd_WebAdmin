<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Authentication Class
 * Makes authentication simple
 */

class Authentication
{
	var $CI;
  var $get_user_id;
	var $user_table = 'users';
	var $roles_table = 'roles';
	var $user_roles_table = 'user_roles';
	var $status_block = '';

	function Authentication()
	{
		// get_instance does not work well in PHP 4
		// you end up with two instances
		// of the CI object and missing data
		// when you call get_instance in the constructor
		//$this->CI =& get_instance();
	}

	/**
	 * Create a user account
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function create($user = '', $password = '', $auto_login = TRUE)
	{
		//Put here for PHP 4 users
		$this->CI =& get_instance();		

		//Make sure account info was sent
		if($user == '' OR $password == '')
		{
			return FALSE;
		}
		
		//Check against user table
		$this->CI->db->where('user_id', $user); 
		$query = $this->CI->db->getwhere($this->user_table);
		
		if ($query->num_rows() > 0)
		{
			//username already exists
			return FALSE;
		}
		else
		{
			//Encrypt password
			$password = md5($password);
			
			//Insert account into the database
			$data = array(
						'user_id' => $user,
						'password' => $password
					);
			$this->CI->db->set($data);
			if(!$this->CI->db->insert($this->user_table))
			{
				//There was a problem!
				return FALSE;
			}
			$user_id = $this->CI->db->insert_id();
			
			//Automatically login to created account
			if($auto_login)
			{
				//Destroy old session
				$this->CI->session->sess_destroy();
				
				//Create a fresh, brand new session
				$this->CI->session->sess_create();
				
				//Set session data
				$this->CI->session->set_userdata(array('user_id' => $user));
				
				//Set logged_in to true
				$this->CI->session->set_userdata(array('logged_in' => TRUE));
			
			}
			
			//Login was successful			
			return TRUE;
		}

	}

	/**
	 * Delete user
	 *
	 * @access	public
	 * @param integer
	 * @return	bool
	 */
	function delete($user_id) {
		//Put here for PHP 4 users
		$this->CI =& get_instance();

		if($this->CI->db->delete($this->user_table, array('user_id' => $user_id)))
		{
			//Database call was successful, user is deleted
			return TRUE;
		}
		else
		{
			//There was a problem
			return FALSE;
		}
	}


	/**
	 * Login and sets session variables
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	function login($user = '', $password = '')
	{
		//Put here for PHP 4 users
		$this->CI =& get_instance();		

		//Make sure login info was sent
		if($user == '' OR $password == '')
		{			
			return FALSE;
		}

		//Check if already logged in
		if($this->get_user_id == $user)
		{
			//User is already logged in.
			return FALSE;
		}
		
		//Check against user table		
		$this->CI->db->where('username', $user); 
		$query = $this->CI->db->getwhere($this->user_table);
		
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array(); 
			
			//Check against password
			if(md5($password) != $row['password'])
			{				
				return FALSE;
			}
			
			$this->CI->db->where('user_id', $row['user_id']); 
			$query_role = $this->CI->db->getwhere($this->user_roles_table);
			
			$role = $query_role->row_array();
                        
                        $query_user = $this->CI->db->get_where($this->user_table, array('user_id' => $row['user_id']));
                        $data_user=$query_user->row_array();
                        
                        $query_role = $this->CI->db->get_where($this->roles_table, array('unid' => $role['role_unid']));
                        $data_role=$query_role->row_array();
			/*
			if($role['role_unid'] == '1')
			{
			
				unset($row['password']);
				
				$this->CI->session->set_userdata(array("user_id_admin" => $row['user_id'], "username_admin" => $row['username']));
				
				$this->CI->session->set_userdata(array('logged_in' => '1', 'level' => '1'));
				
				//Login was successful			
				$this->CI->db->where(array('ip_address' => $_SERVER['REMOTE_ADDR']));
				$this->CI->db->delete('block_ip');
				return TRUE;
			}else{
				return FALSE;
			}*/
                        unset($row['password']);
				
                        $this->CI->session->set_userdata(array("role_id" => $role['role_unid'], "user_id_admin" => $row['user_id'], "username_admin" => $row['username']));
                        $this->CI->session->set_userdata(array('user_full_name' => $data_user["name"], 'role_full_name' => $data_role["name"]));
                        $this->CI->session->set_userdata(array('logged_in' => '1', 'level' => '1'));

                        //Login was successful			
                        $this->CI->db->where(array('ip_address' => $_SERVER['REMOTE_ADDR']));
                        $this->CI->db->delete('block_ip');
                        return TRUE;
		}
		else
		{
			//No database result found			
			return FALSE;
		}	

	}

	function login_user($user = '', $password = '')
	{
		//Put here for PHP 4 users
		$this->CI =& get_instance();		

		//Make sure login info was sent
		if($user == '' OR $password == '')
		{
			return FALSE;
		}

		//Check if already logged in
		if($this->get_user_id == $user)
		{
			//User is already logged in.
			return FALSE;
		}
		
		//Check against user table		
		$this->CI->db->where(array('username'=>$user,"password"=>md5($password),"status_active"=>"Yes")); 
		$query = $this->CI->db->getwhere($this->user_table);
		
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			
			//Check against password
			if(md5($password) != $row['password'])
			{
				return FALSE;
			}
			
			//Destroy old session
			#$this->CI->session->sess_destroy();
			
			//Create a fresh, brand new session
			#$this->CI->session->sess_create();
			
			//Remove the password field
			unset($row['password']);
			
			//Set session data
			#$this->CI->session->set_userdata($row);
			$this->CI->session->set_userdata(array("user_id" => $row['user_id'], "username" => $row['username']));
			
			//Set logged_in to true
			$this->CI->session->set_userdata(array('logged_in_user' => '2', 'level' => '2'));
			
			//Login was successful			
			return TRUE;

		}
		else
		{
			//No database result found
			return FALSE;
		}	

	}
	/**
	 * Check login
	 *
	 * @access	public
	 * @return	void
	 */
	function logged_in()
	{
		//Put here for PHP 4 users
		$this->CI =& get_instance();

		//Check if already logged in
		if($this->CI->session->userdata('logged_in') == '1')
        {
			//User is already logged in.
			return TRUE;
		}
        else
        {
			//User is not logged in yet.
            return FALSE;
        }
	}
	
	function logged_in_user()
	{
		//Put here for PHP 4 users
		$this->CI =& get_instance();

		//Check if already logged in
		if($this->CI->session->userdata('logged_in_user') == '2')
        {
			//User is already logged in.
			return TRUE;
		}
        else
        {
			//User is not logged in yet.
            return FALSE;
        }
	}
	/**
	 * Get current user_id
	 *
	 * @access	public
	 * @return	user_id
	 */
	function get_user_id()
	{
	    //Put here for PHP 4 users
		$this->CI =& get_instance();
		
		//Get user_id
		$user_id = $this->CI->session->userdata('user_id');
		
	    //Return current user_id
	    return ( ! empty($user_id)) ? $user_id : 0;
    }
    
	function get_username()
	{
	    //Put here for PHP 4 users
		$this->CI =& get_instance();
		
		//Get user_id
		$username = $this->CI->session->userdata('username');
		
	    //Return current user_id
	    return ( ! empty($username)) ? $username : 0;
    }
    
    function get_user_fullname()
	{
	    //Put here for PHP 4 users
		$this->CI =& get_instance();
		
		//Get user_id
		$user_full_name = $this->CI->session->userdata('user_full_name');
		
	    //Return current user_id
	    return ( ! empty($user_full_name)) ? $user_full_name : "";
    }
    
    function get_role_fullname()
	{
	    //Put here for PHP 4 users
		$this->CI =& get_instance();
		
		//Get user_id
		$role_full_name = $this->CI->session->userdata('role_full_name');
		
	    //Return current user_id
	    return ( ! empty($role_full_name)) ? $role_full_name : "";
    }
	
	function get_curr_password()
	{
	    $query = $this->CI->db->query("SELECT password FROM ".$this->user_table." WHERE username = '".$this->get_username()."'");        
		if ($query->num_rows() > 0)
		{
		    $data_user=$query->row_array();
			$password=$data_user["password"];
		}else
		{
			$password=0;
		}
		return $password;
    }
	
	function get_member_id()
	{
	    $query = $this->CI->db->query('SELECT * FROM data_members WHERE email = "'.$this->get_username().'"');        
		if ($query->num_rows() > 0)
		{
		    $data_user=$query->row_array();
			$member_id=$data_user["member_id"];
		}else
		{
			$member_id=0;
		}
		return $member_id;
    }
    /**
	 * Get current user roles
	 *
	 * @access	public
	 * @return	role list
	 */
    function get_user_roles()
    {
        //Put here for PHP 4 users
		$this->CI =& get_instance();
		
        $roles = array();
        $query = $this->CI->db->query('SELECT a.role_unid, b.name 
            FROM '.$this->user_roles_table.' a, '.$this->roles_table.' b 
            where (a.role_unid = b.unid) and a.user_id = "'.$this->get_user_id().'"');
        
		if ($query->num_rows() > 0)
		{
		    foreach ($query->result() as $row)
            {
                $roles[] = array('unid'=>$row->role_unid, 'name'=>$row->name);
            }
		}
		
		return $roles;
    }

	/**
	 * Logout user
	 *
	 * @access	public
	 * @return	void
	 */
	function logout($type = "")
	{/*
		//Put here for PHP 4 users
		$this->CI =& get_instance();

		//Destroy session
		#$this->CI->session->sess_destroy();
		
		$this->CI->session->unset_userdata(array("user_id".$type, "username".$type));
		if($type == "_admin")
		{
			$this->CI->session->unset_userdata("logged_in");
		}else{
			$this->CI->session->unset_userdata("logged_in_user");
		}
		
		//$this->CI->session->set_flashdata('error_log',"u heeft afmelden..");
		*/
		$this->CI =& get_instance();

		//Destroy session
		$this->CI->session->sess_destroy();
	}
	
	function get_userdata()
    {
        //Put here for PHP 4 users
		$this->CI =& get_instance();
		
        
        $query = $this->CI->db->query('SELECT * FROM data_members WHERE email = "'.$this->get_username().'"');        
		if ($query->num_rows() > 0)
		{
		    $data_user=$query->row_array();
			$query2 = $this->CI->db->query('SELECT * FROM billing_address WHERE member_id = "'.$data_user["member_id"].'"');        
			if ($query2->num_rows() > 0)
			{
				$data_user2=$query2->row_array();
			}else
			{
				$data_user2="";
			}
		}else
		{
			$data_user="";
		}
		@$data_user_all["dataUser1"]=$data_user;
		@$data_user_all["dataUser2"]=$data_user2;
		return $data_user_all;
    }
	
	function check_ip()
	{
		$this->status_block = '';
		
		$this->CI->db->where(array('ip_address' => $_SERVER['REMOTE_ADDR']));
		$query = $this->CI->db->get('block_ip');
		$n_ip = $query->num_rows();
		$fetch = $query->row_array();
				
		if(isset($_POST['un']) and isset($_POST['ps']))
		{
			if($this->login($_POST['un'], $_POST['ps']) === FALSE)
			{
				
				if($n_ip == 0)
				{
					//$this->CI->db->insert('block_ip',array('ip_address' => $_SERVER['REMOTE_ADDR'], 'date_time' => "'".date('Y-m-d H:i:s')."'", 'log' => '1' ));
					$q_insert = $this->CI->db->query("INSERT INTO block_ip (ip_address,date_time,log) VALUES ('".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d H:i:s')."','1')");
				}else
				{
					if($fetch['log'] >= 3)
					{
						$this->status_block = 'blocked';
						return $this->status_block;
					}
					
					$q = $this->CI->db->query("SELECT TIMESTAMPDIFF(HOUR, date_time, NOW()) as selisih FROM block_ip WHERE ip_address = '".$_SERVER['REMOTE_ADDR']."'");
					$f = $q->row_array();
					if($f['selisih'] <= 24 and $fetch['log'] >= 3)
					{
						$this->status_block = 'blocked';
						return $this->status_block;
					}elseif($f['selisih'] > 24)
					{
							$this->CI->db->where(array('ip_address' => $_SERVER['REMOTE_ADDR']));
							$this->CI->db->delete('block_ip');
							
							$q_insert = $this->CI->db->query("INSERT INTO block_ip (ip_address,date_time,log) VALUES ('".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d H:i:s')."','1')");
					}else{				
						$this->CI->db->where(array('ip_address' => $_SERVER['REMOTE_ADDR']));
						$this->CI->db->set('date_time',date('Y-m-d H:i:s'));
						$this->CI->db->set('log', 'log+1', FALSE);
						$this->CI->db->update('block_ip');
						
						$this->CI->db->where(array('ip_address' => $_SERVER['REMOTE_ADDR']));
						$query = $this->CI->db->get('block_ip');
						$n_ip = $query->num_rows();
						$fetch = $query->row_array();
				
						if($fetch['log'] >= 3)
						{
							$this->status_block = 'blocked';
							return $this->status_block;
						}
					}
				}
			}
		}else{
			if($n_ip != 0 )
			{
				if($fetch['log'] >=3)
				{
					$this->status_block = 'blocked';
					return $this->status_block;
				}
			}
		}		
	}
}
?>
