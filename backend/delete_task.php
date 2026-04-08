<?php
session_start();
include "config/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Unauthorized";
    exit();
}

$id = $_POST['id'];

$sql = "DELETE FROM tasks WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Deleted";
} else {
    echo "Error";
}
?>