<?php 
session_start();
class Database {

    private $host = 'localhost';
    private $db_name = 'courses_db'; 
    private $username = 'root';    
    private $password = ''; 
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
            
            $this->conn = new PDO($dsn, $this->username, $this->password);

            //If Query fails throw an exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
?>