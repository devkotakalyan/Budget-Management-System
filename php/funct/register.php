<?php
session_start();
include '../funct/connection.php'; // Include your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm-password']);
    $role = "user";

    // Validate password match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit();
    }
    
    // Image Upload Handling (Store as BLOB)
    $imageData = null;
    // print_r($_FILES["profile_image"]["name"]);
    if (isset($_FILES["profile_image"]["name"]) && $_FILES["profile_image"]["error"] == 0) {
        $imageData = file_get_contents($_FILES["profile_image"]["name"]); // Read image as binary
    }

    // Insert into the database
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, role, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $password, $role, $null);
    $stmt->send_long_data(4, $imageData);  // Store image as BLOB

    // if ($stmt->execute()) {
    //     echo "<script>alert('User Registered Successfully!'); window.location.href='Adashboard.php';</script>";
    //     exit();
    // } else {
    //     echo "<script>alert('Error: Could not register user.');</script>";
    // }

    $stmt->close();
    $conn->close();
}
?>

