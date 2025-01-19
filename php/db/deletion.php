<?php
require "connection.php";

// Check if an ID is passed
if (isset($_GET['id'])) {
    $b_id = $_GET['id'];

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM budgets WHERE b_id = ?");
    $stmt->bind_param("i", $b_id);

    if ($stmt->execute()) {
        echo "<script>alert('Budget deleted successfully!'); window.location.href='../Admin/budgets.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No ID provided.";
}
?>
