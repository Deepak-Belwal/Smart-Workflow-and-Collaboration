<?php
include "config/db.php";

$sql = "SELECT id, name FROM users WHERE role='member'";
$result = $conn->query($sql);

$users = [];

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
?>