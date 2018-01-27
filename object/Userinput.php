<?php

class Userinput {
 
    // connection and table name
    private $conn;
    private $table_name = "to_do_app";
	
    // object properties
    public $id;
    public $todo_item;
    public $is_done;
    public $date_added;
 
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }
	
	// read, get the data
    function read() {
        // query to get column
        $query = "SELECT id, todo_item, is_done, date_added
				  FROM " . $this->table_name . " 
				  ORDER BY id";
        // query
        $run_query = $this->conn->prepare($query);
        
		// execute query
        $run_query->execute();
        return $run_query;
    }	

	// create to do item
    function create() {
        // query to insert record
        $query = "INSERT INTO " 
				  . $this->table_name . "
				  SET 
                    is_done=:is_done,
                    todo_item=:todo_item";

        // prepare query
        $run_query = $this->conn->prepare($query);
		
        // sanitize
        $this->todo_item = htmlspecialchars(strip_tags($this->todo_item));
        $this->is_done = htmlspecialchars(strip_tags($this->is_done));
 
        // bind values
        $run_query->bindParam(":todo_item", $this->todo_item);
        $run_query->bindParam(":is_done", $this->is_done);
 
        // execute query
        if ($run_query->execute()) {
            return true;
        } else {
            return false;
        }
    }	
	
	function lastid(){
		$last_id = $this->conn->lastInsertId();
		return $last_id;
	}

	// update the department
    function update() {
        // update query
        $query = "UPDATE " 
				 . $this->table_name . 
				 " SET 
					is_done=:is_done
				   WHERE 
				    id=:id";

        // prepare query statement
        $run_query = $this->conn->prepare($query);

        // sanitize
        $this->is_done = htmlspecialchars(strip_tags($this->is_done));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind new values
		$run_query->bindParam(':is_done', $this->is_done);
        $run_query->bindParam(':id', $this->id);

        // execute the query
        if ($run_query->execute()) {
            return true;
        } else {
            return false;
        }
    }	

	// delete users
    function delete() {
        // delete query
        $query = "DELETE FROM " 
				 . $this->table_name . " 
				 WHERE id = ?";

        // prepare query
        $run_query = $this->conn->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $run_query->bindParam(1, $this->id);

        // execute query
        if ($run_query->execute()) {
            return true;
        }

        return false;
    }	
}
