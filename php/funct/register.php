<?php
session_start();
include '../funct/connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm-password']);
    $role = "user"; // Default role

    // Validate passwords
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit();
    }

    // Handle Image Upload (Store as BLOB)
    $imageData = null;
    if (isset($_FILES["profile_image"]) && $_FILES["profile_image"]["error"] == 0) {
        $imageData = file_get_contents($_FILES["profile_image"]["tmp_name"]); // Read image as binary
    }

    // Insert user data into the database
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, role, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $password, $role, $imageData);
    $stmt->send_long_data(4, $imageData);  // Store image as BLOB

    if ($stmt->execute()) {
        echo "<script>alert('User Registered Successfully!'); window.location.href='../Admin/userlist.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error: Could not register user.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
