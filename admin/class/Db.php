<?php
class Db{
    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname ="market";
        
        // Create connection
       $this->conn = new mysqli($servername, $username, $password,$dbname);
        
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " .$this->conn->connect_error);
        }
       
    }

}

?>