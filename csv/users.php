<?php
// csv/users.php

require_once "../api/db_connect.php";

// Set headers for plain text output
header('Content-Type: text/plain');

$query = "SELECT ID, user_login, user_email, user_registered FROM wprr_users";
$result = $conn->query($query);

$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            "ID" => $row['ID'],
            "Username" => $row['user_login'],
            "Email" => $row['user_email'],
            "Registered" => $row['user_registered']
        ];
    }
}

// Output formatted data
echo json_encode($data);
$conn->close();
