<?php
 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/Db.php';
include_once '../object/Userinput.php';
 
// database connection object
$database = new Db();
$db = $database->getConnection();
 
// initialize object
$todo_input = new Userinput($db);
 
// get posted data
$data_input = json_decode(file_get_contents("php://input"));
 
// set todo item property value
$todo_input->todo_item 	= $data_input->todo_item;
$todo_input->is_done 	= $data_input->is_done;

// conditional statement if item are created
if ($todo_input->create()) {
	$todo_input->id = $todo_input->lastid();
	echo json_encode($todo_input);
} else {
    echo '{';
	echo '"message": "Unable to add item."';
	echo '}';
}