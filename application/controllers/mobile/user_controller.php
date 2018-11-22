<?php

class user_controller extends MY_Controller 
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
	public function send_reset_code(){
		$length = 10;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		$newPass = $randomString;
		$userName   = $this->input->post("username",TRUE);
		$email  	= $this->input->post("email",TRUE);
		//$username = "scabalida123";
		//$email = "stephencabalida80@gmail.com";
			$user_data = array(
				'username'       => $username,
				'email'      	 => $email,
				'newpassword'    => $newPass
			);
			
				$this->load->library('email');
				$this->email->set_mailtype("html");
				$this->email->from("info@trademyworld.club", "Trade My World");
				$this->email->to("stephencabalida80@gmail.com");
				$message = "New Password: ".$newPass;
				$this->email->subject("Reset Password");
				$this->email->message($message);

				if($this->email->send()){
					$this->user_model->resetPass($user_data);
					die(json_encode(array("success"=>true )));
				}else{
					die(json_encode(array("success"=>false)));
				}
				
	}
	public function chckUsername()
	{
		$userName   = $this->input->post("username",TRUE);
		$data = $this->user_model->chckUsername($userName);
		
		
		if($data)
		{
			die(json_encode(array("success"=>true )));
		}
		else
		{
			die(json_encode(array("success"=>false)));
		}
	}
	public function addUser()
	{
		$data = $this->user_model->addUser();
		
		
		if($data > 0)
		{
			die(json_encode(array("success"=>true, "user_data"=>$data  )));
		}
		else
		{
			die(json_encode(array("success"=>false, "user_data"=>NULL)));
		}
	}
	public function updateUser()
	{
		$data = $this->user_model->updateUser();
		
		
		if($data)
		{
			die(json_encode(array("success"=>true)));
		}
		else
		{
			die(json_encode(array("success"=>false)));
		}
	}
	public function getUserData()
	{
		$userID      = $this->input->post("userID",TRUE);
		$_login_secret    = (string)$this->input->post("loginSecret",TRUE);

		
		$_system_secret = '0ff9346b4edc8dc033bff30762bc3c15d465d3f';

		$login_data = array(
							'user_id'		 => $userID,
							'_system_secret' => $_system_secret,
							'_login_secret'  => $_login_secret
							);

		$data = $this->user_model->getUserData($login_data);

		if($data != false)
		{
			die(json_encode(array("success"=>true,"user_info"=>$data)));
		}
		else
		{
			die(json_encode(array("success"=>false,"user_info"=>null)));
		}
	}

	public function startSearch(){
		$sk  = $this->input->post("search",TRUE);
		$data = $this->user_model->search($sk);

		if($data != false){
			die(json_encode(array("success"=>true,"search_result"=>$data)));
		}else{
			die(json_encode(array("error"=>true,"search_result"=>$data)));
		}

	}	
	
}

?>