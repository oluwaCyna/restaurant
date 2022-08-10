<?php 

/***************************************
This is my Database control section
****************************************/

class Dbconnect {

	    public $error = [];
        const HOST = "localhost";
        const DBUSER = "root";
        const PASSWORD = "";
        const DBNAME = "restaurant";        
        public $conn;

    public function __construct() {
        if (!$this->conn = new mysqli(self::HOST, self::DBUSER, self::PASSWORD, self::DBNAME)){
        	
        	die("not connected");
        }else{
            return $this->conn;
        }

    }
}



?>