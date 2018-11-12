<?php

class chat_controller extends MY_Controller 
{
	public function __construct() {
		parent::__construct();
		header('Access-Control-Allow-Origin: *'); 
		header('Access-Control-Allow-Headers: content-type'); 
		$this->load->model("mobile/user_model");
	}

	public function insert_chat(){

		$fromTrader = $this->input->post('fromTrader');
		$toTrader = $this->input->post('toTrader');
		$chatMessage = $this->input->post('chatMessage');

		$this->user_model->sendMessage($fromTrader,$toTrader,$chatMessage);
		
		$data = $this->user_model->fetchChatMessages($fromTrader,$toTrader);
		if($data != false){
			die(json_encode(array("success"=>true,"chat_messages"=>$data)));
		}else{
			die(json_encode(array("success"=>true,"chat_messages"=>null)));
		}
		
	}

	public function fetch_messages(){
		$fromTrader = $this->input->post('fromTrader');
		$toTrader = $this->input->post('toTrader');

		$data = $this->user_model->fetchChatMessages($fromTrader,$toTrader);
		if($data != false){
			die(json_encode(array("success"=>true,"chat_messages"=>$data)));
		}else{
			die(json_encode(array("success"=>true,"chat_messages"=>null)));
		}
	}

	public function latest_chat_message(){
		$loggged_id = $this->input->post('loggged_id');
		$toTrader = $this->input->post('toTrader');
		$data = $this->user_model->get_retrieved_message($loggged_id,$toTrader);
		if($data != false){
			die(json_encode(array("success"=>true,"new_message"=>$data)));
		}else{
			die(json_encode(array("success"=>true,"new_message"=>null)));
		}
	}

	// public function latest_chat_message(){
	// 	$fromTrader = $this->input->post('fromTrader');
	// 	$chat_id = $this->input->post('chat_id');
	// 	//$toTrader = $this->input->post('toTrader');
	// 	$data = $this->user_model->get_retrieved_message($fromTrader,$chat_id);
	// 	if($data != false){
	// 		die(json_encode(array("success"=>true,"new_message"=>$data)));
	// 	}else{
	// 		die(json_encode(array("success"=>true,"new_message"=>null)));
	// 	}
	// }

	public function update_latest_message(){
		$chat_id = $this->input->post('chat_id');
		
		$update_status = $this->user_model->update_retrieved_message($chat_id);
		if($update_status != false){
			die(json_encode(array("success"=>true,"status"=>'updated')));
		}else{
			die(json_encode(array("success"=>true,"status"=>null)));
		}

	}

	public function count_unseen_messages(){
		$loggedId =  $this->input->post('user_id');
		$messCount = $this->user_model->all_unseen_messages($loggedId);
		die(json_encode(array("success"=>true,"unseen_messages"=>$messCount)));
	}

	public function fetch_connections(){
		$loggedId =  $this->input->post('user_id');
		$result = $this->user_model->all_connections($loggedId);
		if($result != false){
			die(json_encode(array("success"=>true,"userConnections"=>$result)));
		}else{
			die(json_encode(array("success"=>true,"userConnections"=>null)));
		}
	}
	
		
}

?>