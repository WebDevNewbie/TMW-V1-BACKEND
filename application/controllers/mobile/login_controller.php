<?php

class login_controller extends MY_Controller 
{
	public function __construct() {
		parent::__construct();
		header('Access-Control-Allow-Origin: *'); 
		header('Access-Control-Allow-Headers: content-type'); 
		$this->load->model("mobile/user_model");
	}

	public function index()
	{

	}

	
	public function logIn()
	{
		
		$chrUserName      = $this->input->post("chrUserName",TRUE);
			$passUserPassword = $this->input->post("passUserPassword",TRUE);
			$_login_secret    = (string)$this->input->post("loginSecret",TRUE);

		
		$_system_secret = '0ff9346b4edc8dc033bff30762bc3c15d465d3f';

		$login_data = array(
							'username'		 => $chrUserName,
							'password'       => $passUserPassword,
							'_system_secret' => $_system_secret,
							'_login_secret'  => $_login_secret
							);

		$data = $this->user_model->logIn($login_data);

		if(count($data) > 0)
		{
			die(json_encode(array("success"=>true,"user_info"=>$data)));
		}
		else
		{
			die(json_encode(array("success"=>false,"user_info"=>null)));
		}
	}
	
	public function addUser()
	{
		
		$data = $this->user_model->addUser();

		if(count($data) > 0)
		{
			die(json_encode(array("success"=>true)));
		}
		else
		{
			die(json_encode(array("success"=>false)));
		}
	}
	public function updateTableSetting()
	{
		
		$data = $this->user_model->updateTableSetting();

		if(count($data) > 0)
		{
			die(json_encode(array("success"=>true)));
		}
		else
		{
			die(json_encode(array("success"=>false)));
		}
	}
}

?>