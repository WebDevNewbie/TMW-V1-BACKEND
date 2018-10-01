<?php


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");


$json    =  file_get_contents('php://input');
$obj     =  json_decode($json,true);
$idHolder = $obj['user_id'];

try {
$user = 'root';
$pass = '';
$dbh = new PDO('mysql:host=localhost;dbname=tradeapp', $user, $pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$stmt = $dbh->prepare("SELECT file_name FROM imagefiles WHERE user_id = ?");
$stmt->execute([17]);
$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(!$arr) die(json_encode(array("success"=>false,"file_names"=>null)));
 die(json_encode(array("success"=>true,"file_names"=>$arr)));


