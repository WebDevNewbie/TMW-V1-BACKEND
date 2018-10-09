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
            // $user = $this->get_by(array(
            //     'username' => $login_data['username'],
            //     'password' => md5($login_data['password']),
            // ), TRUE);

            // if(count($user))
            // {
            //     $data = array(	
            //         'user_id'   => $user->user_id,
            //         'username'  => $user->username,
            //         'user_role'  => $user->user_role,
            //     );
            //     return $data;
            // } else {
            // 	return false;
            // }
            $this->db->select('*');
			$this->db->where('username', $login_data['username']);
			$this->db->where('password', md5($login_data['password']));
			$query = $this->db->get('users');
			if($query->num_rows()){
				foreach ($query->result() as $row)
				{
					$data = array(	
	                    'user_id'   => $row->user_id,
	                    'username'  => $row->username,
	                    'user_role'  => $row->user_role,
	                );
				}
				return $data;
			} else {
				return false;
			}
			
        }
    }
	public function getUserData($login_data){
		if($login_data ['_system_secret'] === $login_data['_login_secret'])
        {
            $user = $this->get_by(array(
                'user_id' => $login_data['user_id']
            ), TRUE);

            if($user)
            {
                return $user;
            } else {
            	return false;
            }
        }
	}
	public function getTraderData($login_data){
		if($login_data ['_system_secret'] === $login_data['_login_secret'])
        {
        	$id = $login_data['user_id'];
            // $user = $this->get_by(array(
            //     'user_id' => $login_data['user_id']
            // ), TRUE);
            $user = $this->db->query("SELECT users.*,imagefiles.file_name,videofiles.file_name FROM users,imagefiles,videofiles WHERE imagefiles.user_id = $id AND videofiles.user_id = $id AND users.user_id = $id");

           if($user->num_rows())
            {
                return $user->result();
            } else {
            	return false;
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
		
		$servicename = $this->input->post("servicename",TRUE);
		$servicedesc = $this->input->post("servicedesc",TRUE);
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
							'first_name'	=> $fname,
							'last_name'		=> $lname,
							'age'			=> $age,
							'birthday'		=> $bday,
							'address'		=> $address,
							'service_name'	=> $servicename,
							'service_desc'	=> $servicedesc,
							'user_role' 	=> $user_role
							);

        if($_login_secret === $_system_secret)
        {
			$this->db->insert('users', $data);

			if($this->db->affected_rows() > 0):
				define('MAIN_DIR','MediaFiles/');
				$imageDir = 'Images';
				$userholder = $this->db->insert_id();

				mkdir(MAIN_DIR.$userholder.'/Images',0777,true);
				mkdir(MAIN_DIR.$userholder.'/Videos',0777,true);
				return $this->db->insert_id();
			else:
				return 0; 
			endif;
			
        }
    }
	public function updateUser()
    {
		
		$user_id = $this->input->post("user_id",TRUE);
		$servname = $this->input->post("servname",TRUE);
		$servdesc = $this->input->post("servdesc",TRUE);
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
				'service_name'		=> $servname,
				'service_desc'		=> $servdesc,
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

    public function search($sk){

    	$query = $this->db->query("SELECT user_id, service_name, service_desc,address FROM users WHERE service_name LIKE '%$sk%' ");
    	if($query->num_rows()){
			return $query->result();
    	} else {
    		return false;
    	}

    }

    public function viewTraderdata($traderID){
    	$query = $this->db->query("SELECT * FROM users WHERE user_id = '$traderID'");
    	if($query->num_rows()){
			return $query->result();
    	} else {
    		return false;
    	}
    }

    public function loadMedia($table,$traderID){
    	
    	$query = $this->db->query("SELECT * FROM $table WHERE user_id = '$traderID' ORDER BY dateadded DESC");
    	if($query->num_rows()){
			$finalImages = [];
			foreach($query->result() as $data):
				$initialImage = array(
					'file_name' => $data->file_name,
					'dateadded' => $this->get_real_time($data->dateadded)
				);
				array_push($finalImages,$initialImage);
			endforeach;
			return $finalImages;
    	} else {
    		return false;
    	}
    }

    public function saveFile($table,$user_id,$filename){
    	$data = array(
    		'user_id'		=> $user_id,
			'file_name'		=> $filename,
			'dateadded'		=> date('Y-m-d H:i:s')
		);
    	$this->db->insert($table, $data);
    }

    public function get_real_time($timestamp){

		  $time_ago        = strtotime($timestamp);
		  $current_time    = time();
		  $time_difference = $current_time - $time_ago;
		  $seconds         = $time_difference;
		  
		  $minutes = round($seconds / 60); // value 60 is seconds  
		  $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec  
		  $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;  
		  $weeks   = round($seconds / 604800); // 7*24*60*60;  
		  $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
		  $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60
		                
		  if ($seconds <= 60){

		    return "Just Now";

		  } else if ($minutes <= 60){

		    if ($minutes == 1){

		      return "a minute ago";

		    } else {

		      return "$minutes minutes ago";

		    }

		  } else if ($hours <= 24){

		    if ($hours == 1){

		      return "an hour ago";

		    } else {

		      return "$hours hrs ago";

		    }

		  } else if ($days <= 7){

		    if ($days == 1){

		      return "yesterday";

		    } else {

		      return "$days days ago";

		    }

		  } else if ($weeks <= 4.3){

		    if ($weeks == 1){

		      return "a week ago";

		    } else {

		      return "$weeks weeks ago";

		    }

		  } else if ($months <= 12){

		    if ($months == 1){

		      return "a month ago";

		    } else {

		      return "$months months ago";

		    }

		  } else {
		    
		    if ($years == 1){

		      return "a year ago";

		    } else {

		      return "$years years ago";

		    }
		  }
	}



} #end of Class


?>