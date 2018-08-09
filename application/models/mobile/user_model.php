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
                    'user_id'        => $user->user_id,
                    'username'  => $user->username
                );
                return $data;
            }
        }
    }
	
	public function addUser()
    {
		
		$chrUserName      = $this->input->post("userName",TRUE);
		$passUserPassword = $this->input->post("userPassword",TRUE);
		$userType = $this->input->post("userType",TRUE);
		$_login_secret    = (string)$this->input->post("loginSecret",TRUE);

		$_system_secret = '0ff9346b4edc8dc033bff30762bc3c15d465d3f';

		$data = array(
							'username'		 => $chrUserName,
							'password'       => md5($passUserPassword),
							'usertype' => $userType
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