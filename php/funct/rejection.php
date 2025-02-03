<?php

require "connection.php";

if (isset($_GET['id'])) {

    $b_id = $_GET['id'];

    // Prepare and execute a query to fetch the budget details
    $stmt = $conn->prepare('SELECT b_name, total, rnd, machinery, utilities, marketing FROM asked_budgets WHERE b_id = ?');
    $stmt->bind_param('i', $b_id); // Bind the budget ID as an integer

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        // Check if the budget exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Insert the budget into the stored_budgets table with status 'Rejected'
            $sql = $conn->prepare("INSERT INTO stored_budgets (b_name, total, rnd, machinery, utilities, marketing, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $status = 'Rejected'; // Define the status value
            $sql->bind_param('sddddds', $row['b_name'], $row['total'], $row['rnd'], $row['machinery'], $row['utilities'], $row['marketing'], $status);

            if ($sql->execute()) {
                // Optionally delete the budget from the asked_budgets table
                $deleteStmt = $conn->prepare('DELETE FROM asked_budgets WHERE b_id = ?');
                $deleteStmt->bind_param('i', $b_id);

                if ($deleteStmt->execute()) {
                    echo "<script>window.location.href='../Admin/budgets_req.php';</script>";
                } else {
                    echo "Error deleting the budget from asked_budgets: " . $conn->error;
                }
            } else {
                echo "Error inserting the budget into stored_budgets: " . $conn->error;
            }
        } else {
            echo "No budget found with the given ID.";
        }
    } else {
        echo "Error executing the query: " . $conn->error;
    }
} else {
    echo "No budget ID provided.";
}

?>
