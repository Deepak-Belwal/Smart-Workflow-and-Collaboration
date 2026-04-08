<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    echo "Unauthorized";
    exit();
}
include "config/db.php";

if (!isset($_SESSION['user_id'])) {
    echo "Not logged in";
    exit();
}

$user_id = $_POST['assigned_to'];
$title = $_POST['title'];
$desc = $_POST['description'];
$priority = $_POST['priority'];
$deadline = $_POST['deadline'];

$sql = "INSERT INTO tasks (title, description, priority, deadline, assigned_to) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $title, $desc, $priority, $deadline, $user_id);

if ($stmt->execute()) {
    echo "Task created";
} else {
    echo "Error";
}
?>