<?php
include 'db_connect.php';

$type = $_GET['type'] ?? '';
$filename = $type . '_data_' . date('Ymd') . '.csv';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen("php://output", "w");

if ($type === 'users') {
    fputcsv($output, ['ID', 'Username', 'Email', 'Registered']);
    $query = "SELECT ID, user_login, user_email, user_registered FROM wprr_users";
} elseif ($type === 'pages') {
    fputcsv($output, ['ID', 'Title', 'Date']);
    $query = "SELECT ID, post_title, post_date FROM wprr_posts WHERE post_type = 'page' AND post_status = 'publish'";
} elseif ($type === 'posts') {
    fputcsv($output, ['ID', 'Title', 'Date']);
    $query = "SELECT ID, post_title, post_date FROM wprr_posts WHERE post_type = 'post' AND post_status = 'publish'";
} else {
    die("Invalid data type specified.");
}

$result = $conn->query($query);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();
