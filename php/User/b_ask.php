<?php

    session_start();

    require "../db/connection.php";

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="../../CSS/userslist.css">
</head>
<body>
<header>
        <div class="arr">
            <a href="../User/Udashboard.php">Go Back</a>
        </div>
        <div class="fld">
            <h1>Budget Management</h1>
            <p>Your Budgets</p>
        </div>
        <div class="log">
            <p><?php echo "Welcome ". $_SESSION['username'] ?></p>
        </div>
    </header>
    <div class="user-list-container">
        <h2>Budget List</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Budget ID</th>
                    <th>Budget Name</th>
                    <th>Total</th>
                    <th>R&D</th>
                    <th>Machinery</th>
                    <th>Utilities</th>
                    <th>Marketing</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['b_id']}</td>
                    <td>{$row['b_name']}</td>
                    <td>{$row['total']}</td>
                    <td>{$row['rnd']}</td>
                    <td>{$row['machinery']}</td>
                    <td>{$row['utilities']}</td>
                    <td>{$row['marketing']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No budgets found</td></tr>";
            }
            ?>

            </tbody>
        </table>
    </div>
</body>
</html>

