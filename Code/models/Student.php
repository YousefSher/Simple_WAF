<?php
require_once __DIR__ . '/../Database/db.php';

class Student {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // ❌ INTENTIONALLY VULNERABLE
    public function login($email, $password) {
        $sql = "SELECT * FROM student 
                WHERE email = '$email' 
                AND password = '$password'";
        return $this->conn->query($sql);
    }
}
