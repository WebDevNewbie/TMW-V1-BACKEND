<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");


$json    =  file_get_contents('php://input');
$obj     =  json_decode($json,true);
$key = $obj['key'];
$data = $obj['base64'];
$userHolder = $obj['user_id'];
  

function upload_file($encoded_string,$userHolder){
	define('MAIN_DIR', 'public_html/MediaFiles/');
	
	$decoded_file = base64_decode($encoded_string);
	$mime_type = finfo_buffer(finfo_open(), $decoded_file, FILEINFO_MIME_TYPE);
	$extension = mimeTotext($mime_type);
	
	$file = uniqid() .'.'. $extension;
	$file_dir = MAIN_DIR . $userHolder .'/Images/' . uniqid() .'.'. $extension;
	try {
		file_put_contents($file_dir, $decoded_file);
		saveTodb($userHolder,$file);
		header('Content-Type: application/json');
		echo json_encode(array("success" => true, "message" => "Trade Image successfully Uploaded")); 
	} catch (Exception $e) {
		header('Content-Type: application/json');
		echo json_encode(array("success" => false, "message" => $e->getMessage())); 
	}

}

function mimeTotext($mime){
	$all_mimes = '{"jpeg":["image\/jpeg","image\/p-jpeg"]}';
	$all_mimes = json_decode($all_mimes,true);
	foreach($all_mimes as $key => $value){
		if(array_search($mime,$value) !== false ) return $key;
	}
	return false;
}

function saveToDb($user_id,$file){

	try {
		$user = 'root';
		$pass = '';
		$dbh = new PDO('mysql:host=localhost;dbname=tradeapp', $user, $pass);
	} catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    die();
	}

	$stmt = $dbh->prepare("INSERT INTO imagefiles (user_id, file_name) VALUES (:idOfuser, :file)");
	$stmt->bindParam(':idOfuser', $user_id);
	$stmt->bindParam(':file', $file);
	$stmt->execute();
}

if($key == "upload"){
	upload_file($data,$userHolder);
}

