<?php
require_once "db_connect.php";

$limit = 10;  // 10 users per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$query = "SELECT * FROM wprr_users LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

// Pagination links
$total_query = "SELECT COUNT(*) AS total FROM wprr_users";
$total_result = $conn->query($total_query);
$total = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total / $limit);

$response = [
    "page" => $page,
    "total_pages" => $total_pages,
    "users" => $users,
    "next_page" => $page < $total_pages ? "https://apitest.impactlightworld.com.ng/users?page=" . ($page + 1) : null,
    "prev_page" => $page > 1 ? "https://apitest.impactlightworld.com.ng/users?page=" . ($page - 1) : null
];

echo json_encode($response);
