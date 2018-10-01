<?php

	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

	$json    =  file_get_contents('php://input');
	$obj     =  json_decode($json,true);
	$username = $obj['username'];

	//die($username);

	try {
	$user = 'root';
	$pass = '';
    $dbh = new PDO('mysql:host=localhost;dbname=tradeapp', $user, $pass);
	} catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    die();
	}
	
	$stmt = $dbh->prepare("SELECT * FROM users WHERE username = ?");
	$stmt->execute([$username]);
	$arr = $stmt->fetch(PDO::FETCH_ASSOC);

	if(!$arr) die(json_encode(array("success"=>true )));
	 die(json_encode(array("success"=>false)));


?>




