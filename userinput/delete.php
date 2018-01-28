<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
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

// set ID property of item to be deleted
$todo_input->id = filter_input(INPUT_GET, 'id');

// delete the item
if ($todo_input->delete()) {
    echo '{';
    echo '"message": "To do item was deleted."';
    echo '}';
} else {
    echo '{';
    echo '"message": "Unable to delete item."';
    echo '}';
}
?>