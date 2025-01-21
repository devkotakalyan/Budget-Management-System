<?php

require "connection.php";

if (isset($_GET['id'])) {
    $b_id = $_GET['id'];

    $stmt = $conn->prepare('SELECT b_name, rnd, machinery, utilities, marketing FROM asked_budgets WHERE b_id = ?');
    $stmt->bind_param('i', $b_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $sql = $conn->prepare("INSERT INTO budgets (b_name, rnd, machinery, utilities, marketing) VALUES (?, ?, ?, ?, ?)");
            $sql->bind_param('sdddd', $row['b_name'],$row['rnd'], $row['machinery'], $row['utilities'], $row['marketing']);

            if ($sql->execute()) {
                
                    $stm = $conn->prepare("DELETE FROM asked_budgets WHERE b_id = ?");
                    $stm->bind_param('i', $b_id);
                    $stm->execute();
                    echo "<script>alert('Budget Approved successfully!'); window.location.href='../Admin/budgets.php';</script>";

            } else {
                echo "Error inserting data: " . $sql->error;
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
