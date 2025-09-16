<?php
// Database configuration
$host = 'localhost'; // Change if necessary
$dbname = 'vaitrem_db';
$username = 'root'; // Change to your MySQL username
$password = 'root'; // Change to your MySQL password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");
?>
