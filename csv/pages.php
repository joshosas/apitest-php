<?php
// csv/pages.php

require_once "../db_connect.php";

// Set headers for plain text
header('Content-Type: text/plain');

// Query to fetch pages data
$query = "SELECT ID, post_title, post_date FROM wprr_posts WHERE post_type = 'page' AND post_status = 'publish'";
$result = $conn->query($query);


// Output each row as CSV
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "{$row['ID']},{$row['post_title']},{$row['post_date']}\n";
    }
}

$conn->close();
