<?php
// csv/pages.php

require_once "../api/db_connect.php";

// Set headers for plain text output
header('Content-Type: text/plain');

$query = "SELECT ID, post_title, post_date FROM wprr_posts WHERE post_type = 'page' AND post_status = 'publish'";
$result = $conn->query($query);

$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            "ID" => $row['ID'],
            "Title" => $row['post_title'],
            "Date" => $row['post_date']
        ];
    }
}

// Output formatted data
echo json_encode($data);
$conn->close();
