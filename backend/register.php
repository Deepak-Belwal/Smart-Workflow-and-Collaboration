<?php
$conn = new mysqli("localhost", "root", "[password]", "[database_name]");

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$imageName = "";

if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {

    $folder = "../uploads/";
    $imageName = time() . "_" . $_FILES['profile_image']['name'];

    move_uploaded_file($_FILES['profile_image']['tmp_name'], $folder . $imageName);
}

$sql = "INSERT INTO users (name, email, password, role, profile_image)
        VALUES ('$name', '$email', '$password', 'member', '$imageName')";

$conn->query($sql);

echo "Registered successfully";
?>