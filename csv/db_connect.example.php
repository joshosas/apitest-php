<?php
$host = "your_database_host"; // e.g., "localhost"
$username = "your_database_username";
$password = "your_database_password";
$database = "your_database_name";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
