<?php
header("Content-Type: application/json");

$api_info = [
    "message" => "Welcome to Impact Light API",
    "endpoints" => [
        "Users" => "https://apitest.impactlightworld.com.ng/users?page=1",
        "Posts" => "https://apitest.impactlightworld.com.ng/posts?page=1",
        "Pages" => "https://apitest.impactlightworld.com.ng/pages?page=1"
    ]
];

echo json_encode($api_info);
