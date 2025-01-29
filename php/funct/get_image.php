<?php
session_start();
require "../funct/connection.php";

$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT image FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($imageData);
$stmt->fetch();
$stmt->close();
$conn->close();

if ($imageData) {
    header("Content-type: image/jpg"); // Change if storing PNG
    echo $imageData;
} else {
    readfile("../../uploads/propic.jpg"); // Show default image if none exists
}
?>
