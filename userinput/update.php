<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
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
$data_input = json_decode(file_get_contents("php://input", true));

// set id of item
$todo_input->id = $data_input->id;

// set boolean is_done value
$todo_input->is_done = $data_input->is_done;

// update the user
if ($todo_input->update()) {
    echo '{';
    echo '"message": "User was to-do item."';
    echo '}';
} else {
    echo '{';
    echo '"message": "Unable to update to-do item."';
    echo '}';
}