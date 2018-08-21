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
	
}

?>