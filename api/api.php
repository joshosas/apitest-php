<?php
$request_uri = trim($_SERVER['REQUEST_URI'], '/');

// Removes "apitest."
$request_uri = str_replace("apitest.", "", $request_uri);

switch ($request_uri) {
    case "users":
        require_once "users.php";
        break;
    case "posts":
        require_once "posts.php";
        break;
    case "pages":
        require_once "pages.php";
        break;
    default:
        echo json_encode(["message" => "Invalid API endpoint"]);
}
