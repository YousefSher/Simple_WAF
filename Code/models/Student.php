<?php
require_once __DIR__ . '/../Database/db.php';

class Student {

    private $conn;
    private $table = 'student';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // SECURE (prepared statement, NOT hashed as requested)
    public function login($email, $password) {

        $query = "SELECT * FROM {$this->table} 
                  WHERE email = :email 
                  AND password = :password";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        return $stmt; // return PDOStatement, not fetchAll yet
    }
}
