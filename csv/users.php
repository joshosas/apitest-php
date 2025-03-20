<?php
// csv/users.php

require_once "../db_connect.php";

// Set headers for plain text
header('Content-Type: text/plain');

// Query to fetch all user data
$query = "SELECT * FROM wprr_users";
$result = $conn->query($query);


// Output each row as CSV
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "{$row['ID']},{$row['user_login']},{$row['user_email']},{$row['user_registered']}\n";
    }
}

$conn->close();
