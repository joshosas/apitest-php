<?php
header('Content-Type: application/json');
include 'db_connect.php';

$data = [];

// Fetch Users
$user_sql = "SELECT ID, user_login, user_email, user_registered FROM wprr_users";
$user_result = $conn->query($user_sql);
$users = [];
if ($user_result && $user_result->num_rows > 0) {
    while ($row = $user_result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Fetch Pages
$page_sql = "SELECT ID, post_title, post_date FROM wprr_posts WHERE post_type = 'page' AND post_status = 'publish'";
$page_result = $conn->query($page_sql);
$pages = [];
if ($page_result && $page_result->num_rows > 0) {
    while ($row = $page_result->fetch_assoc()) {
        $pages[] = $row;
    }
}

// Fetch Posts
$post_sql = "SELECT ID, post_title, post_date FROM wprr_posts WHERE post_type = 'post' AND post_status = 'publish'";
$post_result = $conn->query($post_sql);
$posts = [];
if ($post_result && $post_result->num_rows > 0) {
    while ($row = $post_result->fetch_assoc()) {
        $posts[] = $row;
    }
}

// Combine Data
$data['users'] = $users;
$data['pages'] = $pages;
$data['posts'] = $posts;

echo json_encode($data);
$conn->close();
?>
