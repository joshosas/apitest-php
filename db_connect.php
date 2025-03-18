<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Remote Database credentials
$servername = "localhost"; //
$username = "impactli_wp956";
$password = "Svu55.!5Lp";
$dbname = "impactli_wp956";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Database connection successful oo!";
