<?php

class upload_controller extends MY_Controller 
{
	public function __construct() {
		parent::__construct();
		header('Access-Control-Allow-Origin: *'); 
		header('Access-Control-Allow-Headers: content-type'); 
		$this->load->model("mobile/user_model");
	}

	public function upload_image(){
		
		$_login_secret    = (string)$this->input->post("loginSecret",TRUE);
		$encoded_string = $this->input->post("base64",TRUE);
		$folder = $this->input->post("folder",TRUE);
		$userHolder = $this->input->post("user_id",TRUE);
		define('MAIN_DIR', $_SERVER['DOCUMENT_ROOT'].'/tradeappbackend/public_html/MediaFiles/');
		
		$decoded_file = base64_decode($encoded_string);
		$mime_type = finfo_buffer(finfo_open(), $decoded_file, FILEINFO_MIME_TYPE);
		$extension = $this->mimeTotext($mime_type);
		
		$file = uniqid() .'.'. $extension;
		$file_dir = MAIN_DIR . $userHolder .'/'.$folder.'/' . $file;
		if($folder == 'Images'){
			$typeOfFile = 'Image';
			$table = 'imagefiles';
		} else {
			$typeOfFile = 'Video';
			$table = "videofiles";
		}
		try {
			file_put_contents($file_dir, $decoded_file);
			header('Content-Type: application/json');
			$this->user_model->saveFile($table,$userHolder,$file);
			echo json_encode(array("success" => true, "message" => "Trade $typeOfFile successfully Uploaded")); 
		} catch (Exception $e) {
			header('Content-Type: application/json');
			echo json_encode(array("success" => false, "message" => $e->getMessage())); 
		}

	}

	public function mimeTotext($mime){
		$all_mimes = '{"jpeg":["image\/jpeg","image\/p-jpeg"],"3gp":["video\/3gp"],"mp4":["video\/mp4"]}';
		$all_mimes = json_decode($all_mimes,true);
		foreach($all_mimes as $key => $value){
			if(array_search($mime,$value) !== false ) return $key;
		}
		return false;
	}

	public function upload_video(){
		$user_id = $this->input->post('user');
		$target_path = $_SERVER['DOCUMENT_ROOT'].'/tradeappbackend/public_html/MediaFiles/'.$user_id.'/Videos/'. basename( $_FILES['file']['name']);
		  
		if (move_uploaded_file($_FILES['file']['tmp_name'],$target_path)) {
			$table = "videofiles";
			$this->user_model->saveFile($table,$user_id,$_FILES['file']['name']);
		    echo "Trade Video upload success!";
		} else {
			echo $target_path;
		    echo "There was an error uploading the file, please try again!";
		}
	}

	public function ListImages(){

		$json    =  file_get_contents('php://input');
		$obj     =  json_decode($json,true);
		$idHolder = $obj['user_id'];
		
		$data = $this->user_model->loadImages($idHolder);

		if($data != false)
		{
			 die(json_encode(array("success"=>true,"file_names"=>$data)));

		}
		else
		{
			 die(json_encode(array("success"=>true,"file_names"=>null)));

		}

	}

		
}

?>