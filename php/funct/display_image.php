<?php
include '../funct/connection.php';

if (!isset($_GET['email'])) {
    echo "No image found.";
    exit();
}

$email = $_GET['email'];

$stmt = $conn->prepare("SELECT image FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($imageData);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    if (!empty($imageData)) {
        echo "Image retrieved successfully.";
    } else {
        echo "Image data is empty.";
    }
    
}


header("Content-Type: image/jpeg");
readfile(__DIR__ . "/../../pics/uploads/admin-icon-vector.jpg");
exit();
?>
