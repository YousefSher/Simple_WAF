<?php 
    session_start();
    //connect to database
    $servername = "localhost";
    $username = "root";
    $pass = "";
    $dbname = "courses_db";

    $conn = new mysqli($servername, $username, $pass, $dbname);
    if($conn->connect_error){
        die("Connection error:" . $conn->connect_error); 
    }    
?>