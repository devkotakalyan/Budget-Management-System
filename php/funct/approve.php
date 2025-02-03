<?php

require "connection.php";

if (isset($_GET['id'])) {
    $b_id = $_GET['id'];

    // Fetch budget details from `asked_budgets`
    $stmt = $conn->prepare('SELECT b_name, total, rnd, machinery, utilities, marketing FROM asked_budgets WHERE b_id = ?');
    $stmt->bind_param('i', $b_id); 

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Insert into `budgets` table
            $sql = $conn->prepare("INSERT INTO budgets (b_name, total, rnd, machinery, utilities, marketing) VALUES (?, ?, ?, ?, ?, ?)");
            $sql->bind_param('sddddd', $row['b_name'], $row['total'], $row['rnd'], $row['machinery'], $row['utilities'], $row['marketing']);

            if ($sql->execute()) {
                // Fetch the last inserted ID (b_id) from `budgets`
                $last_b_id = $conn->insert_id;

                // Insert into `stored_budgets` table with status 'Approved' and the same b_id
                $store_stmt = $conn->prepare("INSERT INTO stored_budgets (b_id, b_name, total, rnd, machinery, utilities, marketing, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $status = 'Approved';
                $store_stmt->bind_param('isddddds', $last_b_id, $row['b_name'], $row['total'], $row['rnd'], $row['machinery'], $row['utilities'], $row['marketing'], $status);

                if ($store_stmt->execute()) {
                    // Delete from `asked_budgets`
                    $stm = $conn->prepare("DELETE FROM asked_budgets WHERE b_id = ?");
                    $stm->bind_param('i', $b_id);
                    $stm->execute();

                    echo "<script>window.location.href='../Admin/budgets.php';</script>";
                } else {
                    echo "Error storing data in stored_budgets: " . $store_stmt->error;
                }
            } else {
                echo "Error inserting data into budgets: " . $sql->error;
            }
        } else {
            echo "No data found with the given ID.";
        }
    } else {
        echo "Error fetching the request.";
    }
} else {
    echo "No ID provided.";
}

?>
