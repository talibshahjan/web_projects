<?php
// Task 3: Database connection using object-oriented MySQLi
$host     = "localhost";
$username = "root";
$password = "";            // XAMPP default: empty password
$database = "admission_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
