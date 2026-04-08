<?php
session_start();
include "config/db.php";

if (!isset($_SESSION['user_id'])) {
    echo "Unauthorized";
    exit();
}

$id = $_POST['id'];
$status = $_POST['status'];
$user_id = $_SESSION['user_id'];

// 🔥 Check if this task belongs to the user
$sql = "SELECT assigned_to FROM tasks WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$task = $result->fetch_assoc();

if (!$task || $task['assigned_to'] != $user_id) {
    echo "Unauthorized";
    exit();
}

// ✅ Update allowed
$sql = "UPDATE tasks SET status=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $id);

if ($stmt->execute()) {
    echo "Updated";
} else {
    echo "Error";
}
?>