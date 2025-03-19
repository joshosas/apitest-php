<?php
require_once "db_connect.php";
header('Content-Type: application/json');

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$query = "SELECT ID, post_title, post_date FROM wprr_posts WHERE post_type = 'post' AND post_status = 'publish' LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

if (!$result) {
    echo json_encode(["error" => $conn->error]);
    exit;
}

$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

$total_query = "SELECT COUNT(*) AS total FROM wprr_posts WHERE post_type = 'post' AND post_status = 'publish'";
$total_result = $conn->query($total_query);
$total = $total_result->fetch_assoc()['total'] ?? 0;
$total_pages = ceil($total / $limit);

$response = [
    "page" => $page,
    "total_pages" => $total_pages,
    "posts" => $posts,
    "next_page" => $page < $total_pages ? "https://apitest.impactlightworld.com.ng/posts?page=" . ($page + 1) : null,
    "prev_page" => $page > 1 ? "https://apitest.impactlightworld.com.ng/posts?page=" . ($page - 1) : null
];

echo json_encode($response);
$conn->close();
