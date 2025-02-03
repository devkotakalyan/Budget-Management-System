<?php
require "connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user image path
    $stmt = $conn->prepare("SELECT image, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($imagePath, $email);
    $stmt->fetch();
    $stmt->close();

    // Sanitize email to match folder structure
    $safeEmail = preg_replace('/[^a-zA-Z0-9]/', '_', $email);
    $userFolder = "../../pics/uploads/" . $safeEmail;

    // Delete user image if it's not the default image
    if ($imagePath && $imagePath !== "user.jpg") {
        $fileToDelete = "../../pics/uploads/" . $imagePath;
        if (file_exists($fileToDelete)) {
            unlink($fileToDelete);
        }
    }

    // Function to delete folder and its files
    function deleteFolder($folderPath) {
        if (!is_dir($folderPath)) return;
        $files = array_diff(scandir($folderPath), array('.', '..'));
        foreach ($files as $file) {
            $filePath = $folderPath . '/' . $file;
            is_dir($filePath) ? deleteFolder($filePath) : unlink($filePath);
        }
        rmdir($folderPath);
    }

    // Delete user's folder if it exists
    if (is_dir($userFolder)) {
        deleteFolder($userFolder);
    }

    // Delete user from database
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully!'); window.location.href='../Admin/userlist.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No ID provided.";
}
?>
