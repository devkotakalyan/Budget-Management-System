<?php
session_start();
include '../funct/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $role = "user";

    // Sanitize email to use as a folder name
    $safeEmail = preg_replace('/[^a-zA-Z0-9]/', '_', $email);

    // Define the user's folder
    $userFolder = "../../pics/uploads/" . $safeEmail . "/";

    // Create user-specific folder if it doesn't exist
    if (!is_dir($userFolder)) {
        mkdir($userFolder, 0777, true);
    }

    // File Upload Handling
    $imagePath = "user.jpg"; // Default profile image

    if (!empty($_FILES["profile_image"]["name"])) {
        $imgn = $_FILES["profile_image"]["name"];
        $imgtn = $_FILES["profile_image"]["tmp_name"];
        $targetFile = $userFolder . basename($imgn);

        if (move_uploaded_file($imgtn, $targetFile)) {
            $imagePath = $safeEmail . "/" . basename($imgn); // Store relative path
        }
    }

    // Insert user into database
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, role, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $password, $role, $imagePath);

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
