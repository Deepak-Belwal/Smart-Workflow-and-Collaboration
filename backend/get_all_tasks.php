<?php
session_start();
include "config/db.php";

// 🔒 Only admin allowed
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo json_encode([]);
    exit();
}

$sql = "SELECT tasks.id, tasks.title, tasks.status, users.name 
        FROM tasks 
        JOIN users ON tasks.assigned_to = users.id";

$result = $conn->query($sql);

$tasks = [];

while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}

echo json_encode($tasks);
?>