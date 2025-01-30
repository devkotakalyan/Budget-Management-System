<?php
include "connection.php"; // Include your database connection

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Fetch image from the database
    $stmt = $conn->prepare("SELECT image FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($imageData);
    $stmt->fetch();

    if ($imageData) {
        // Output the image with the correct MIME type
        header("Content-Type: image/png");
        echo $imageData;
    } else {
        // Display a default image if none exists
        header("Content-Type: image/png");
        readfile("../../pics/uploads/default_profile.png"); // Ensure you have a default image
    }

    $stmt->close();
    $conn->close();
}
?>
