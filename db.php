<?php
$host = 'localhost'; 
$dbname = 'vaitrem_db';
$username = 'root'; 
$password = 'root'; 

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
