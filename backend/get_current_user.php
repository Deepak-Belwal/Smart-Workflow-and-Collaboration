<?php
session_start();

$conn = new mysqli("localhost", "root", "[password]", "[database_name]");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["logged_in" => false]);
    exit();
}

$user_id = $_SESSION['user_id'];

// 🔥 FETCH USER FROM DB
$result = $conn->query("SELECT name, email, role, profile_image FROM users WHERE id = $user_id");

$user = $result->fetch_assoc();

echo json_encode([
    "logged_in" => true,
    "user_id" => $user_id,
    "name" => $user['name'],
    "email" => $user['email'],
    "role" => $user['role'],
    "profile_image" => $user['profile_image']
]);
?>