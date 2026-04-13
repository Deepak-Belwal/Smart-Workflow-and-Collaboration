<?php
session_start();

$conn = new mysqli("localhost", "root", ""[password]", "[database_name]");

$user_id = $_SESSION['user_id'];

$name = $_POST['name'];
$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];

// 🔥 FETCH CURRENT USER
$result = $conn->query("SELECT * FROM users WHERE id=$user_id");
$user = $result->fetch_assoc();

// ------------------
// PASSWORD CHECK
// ------------------
if (!empty($newPassword)) {

    if (!password_verify($currentPassword, $user['password'])) {
        echo "Current password incorrect";
        exit();
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $conn->query("UPDATE users SET password='$hashedPassword' WHERE id=$user_id");
}

// ------------------
// NAME UPDATE
// ------------------
if (!empty($name)) {
    $conn->query("UPDATE users SET name='$name' WHERE id=$user_id");
}

// ------------------
// IMAGE UPDATE
// ------------------
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {

    $folder = "../uploads/";
    $imageName = time() . "_" . $_FILES['profile_image']['name'];

    move_uploaded_file($_FILES['profile_image']['tmp_name'], $folder . $imageName);

    $conn->query("UPDATE users SET profile_image='$imageName' WHERE id=$user_id");
}

echo "Profile updated successfully";
?>