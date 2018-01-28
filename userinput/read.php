<?php
 
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/Db.php';
include_once '../object/Userinput.php';
 
// database connection object
$database = new Db();
$db = $database->getConnection();
 
// initialize object
$todo_input = new Userinput($db);
 
// query registered users
$run_query = $todo_input->read();
$row_num = $run_query->rowCount();
 
// check if more than 0 record found
if ($row_num > 0) {
    $todo_list_arr = array();
    $todo_list_arr['todo_list'] = array();
 
    // retrieve table contents
    while ($row_num = $run_query->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        extract($row_num);
        $todo_list_item = array(
            "id" => $row_num['id'],
            "todo_item" => $row_num['todo_item'],
            "is_done" => $row_num['is_done'],
            "date_added" => $row_num['date_added']
        );
        array_push($todo_list_arr['todo_list'], $todo_list_item);
    }
    echo json_encode($todo_list_arr);
} else {
    echo json_encode(
            //array("message" => "No to do list found.")
            array("id" => null)
    );
}
?>