<?php
class user_model extends MY_Model 
{
	
	protected $_table_name = 'users';
	protected $_order_by = 'user_id';
    protected $_timestamps = TRUE;

    

    function __construct() {
        parent::__construct();
    }

    public function logIn($login_data)
    {
        if($login_data['_system_secret'] === $login_data['_login_secret'])
        {
            $user = $this->get_by(array(
                'username' => $login_data['username'],
                'password' => md5($login_data['password']),
            ), TRUE);

            if(count($user))
            {
                $data = array(
                    'user_id'   => $user->user_id,
                    'username'  => $user->username,
                    'user_role'  => $user->user_role,
                );
                return $data;
            }
        }
    }
	public function getUserData($login_data){
		if($login_data['_system_secret'] === $login_data['_login_secret'])
        {
            $user = $this->get_by(array(
                'user_id' => $login_data['user_id']
            ), TRUE);

            if(count($user))
            {
                return $user;
            }
        }
	}
	public function chckUsername($username){
		$query = $this->db->get_where('users', array('username' => $username));
		if ($query->num_rows() > 0)
		{
		   return true;
		}else{
			return false;
		}
	}
	public function addUser()
    {
		
		$userName = $this->input->post("username",TRUE);
		$password = $this->input->post("password",TRUE);
		$fname = $this->input->post("fname",TRUE);
		$lname = $this->input->post("lname",TRUE);
		$age = $this->input->post("age",TRUE);
		$bday = $this->input->post("bday",TRUE);
		$address = $this->input->post("address",TRUE);
		$user_role = $this->input->post("package",TRUE);
		$_login_secret    = (string)$this->input->post("loginSecret",TRUE);

		$_system_secret = '0ff9346b4edc8dc033bff30762bc3c15d465d3f';

		$data = array(
							'username'		=> $userName,
							'password'      => md5($password),
							'first_name'		=> $fname,
							'last_name'		=> $lname,
							'age'		=> $age,
							'birthday'		=> $bday,
							'address'		=> $address,
							'user_role' 	=> $user_role
							);

        if($_login_secret === $_system_secret)
        {
			$this->db->insert('users', $data); 
			if($this->db->affected_rows() > 0)
				return $this->db->insert_id();
			else
				return 0; 
			
        }
    }
	public function updateUser()
    {
		
		$user_id = $this->input->post("user_id",TRUE);
		$fname = $this->input->post("fname",TRUE);
		$lname = $this->input->post("lname",TRUE);
		$age = $this->input->post("age",TRUE);
		$bday = $this->input->post("bday",TRUE);
		$address = $this->input->post("address",TRUE);
		if($this->input->post("activity",TRUE) == ""){
			$activity = $this->input->post("activity",TRUE);
		}else{$activity = json_encode($this->input->post("activity",TRUE));}
		$occupation = $this->input->post("occupation",TRUE);
		$hobbies = $this->input->post("hobbies",TRUE);
		$skill = $this->input->post("skill",TRUE);
		$learn = $this->input->post("learn",TRUE);
		$todo = $this->input->post("todo",TRUE);
		$visit = $this->input->post("visit",TRUE);
		$language = $this->input->post("language",TRUE);
		$education = $this->input->post("education",TRUE);
		$collegecourse = $this->input->post("collegecourse",TRUE);
		$certificate = $this->input->post("certificate",TRUE);
		$prefer_group = $this->input->post("prefer_group",TRUE);
		$prefer_place = $this->input->post("prefer_place",TRUE);
		$civil_status = $this->input->post("civil_status",TRUE);
		$live_athome = $this->input->post("live_athome",TRUE);
		$religion = $this->input->post("religion",TRUE);
		$children = $this->input->post("children",TRUE);
		$ethniticity = $this->input->post("ethniticity",TRUE);
		$_login_secret    = (string)$this->input->post("loginSecret",TRUE);

		$_system_secret = '0ff9346b4edc8dc033bff30762bc3c15d465d3f';

			$data = array(
				'first_name'		=> $fname,
				'last_name'			=> $lname,
				'age'				=> $age,
				'birthday'			=> $bday,
				'address'			=> $address,
				'activity'			=> $activity,
				'occupation'		=> $occupation,
				'hobbies'			=> $hobbies,
				'skills'			=> $skill,
				'learn'				=> $learn,
				'todo'				=> $todo,
				'visit'				=> $visit,
				'languages'			=> $language,
				'education'			=> $education,
				'collegecourse'		=> $collegecourse,
				'certificate'		=> $certificate,
				'prefer_group'		=> $prefer_group,
				'prefer_place'		=> $prefer_place,
				'religion'			=> $religion,
				'civil_status'		=> $civil_status,
				'children'			=> $children,
				'live_athome'		=> $live_athome,
				'ethniticity' 		=> $ethniticity
			);

        if($_login_secret === $_system_secret)
        {
			$this->db->update('users', $data, array('user_id' => $user_id));
			return true;
        }
    }
	public function updateTableSetting() {
		$table_settings = $this->input->post("table_no",TRUE);
		$_login_secret    = (string)$this->input->post("loginSecret",TRUE);
		$_system_secret = '0ff9346b4edc8dc033bff30762bc3c15d465d3f';
        
		if($_login_secret === $_system_secret)
        {
			$this->db->update('table_settings', array('table_no' => $table_settings ), array('id' => 2));
			return true;
			
        }
		
		
    }
	public function changePass($user_data)
    {
        if($user_data['_system_secret'] === $user_data['_login_secret'])
        {
            $user = $this->get_by(array(
                'user_id' => $user_data['user_id'],
                'password' => md5($user_data['password'])
            ), TRUE);
			//print_r(count($user));
           if(count($user) > 0)
            {
                $data = array(
					'password' => md5($user_data['newpassword'])
				);

				$query = $this->db->update('users', $data, array('user_id' => $user_data['user_id']));
				if($query){
					return true;
				}else{
					return false;
				}
            }else{
				return false;
			}
        }
    }
    public function loggedin() {
        return (bool) $this->session->userdata('loggedin');
    }
    public function userId()
    {
        return $this->session->userdata('id');
    }
    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }

} #end of Class


?>