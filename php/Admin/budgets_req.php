<?php

    session_start();

    require "../funct/connection.php";

    $sql = "SELECT * FROM asked_budgets ";
    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requested Budget</title>
    <link rel="stylesheet" href="../../CSS/userslist.css">
</head>
<body>
    <header>
        <div class="arr">
            <a href="Adashboard.php">Go Back</a>
        </div>
        <div class="fld">
            <h2 class="subtitle">Budget Request</h2>
        </div>
        <div class="log">
            <p><?php echo "Welcome, " . $_SESSION['username']; ?></p>
        </div>
    </header>
    <div class="wrapper">
        <table class="user-table">
            <thead>
                <tr>
                    <th>S ID</th>
                    <th>S Email</th>
                    <th>Budget Name</th>
                    <th>Total</th>
                    <th>R&D</th>
                    <th>Machinery</th>
                    <th>Utilities</th>
                    <th>Marketing</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['b_id']}</td>
                    <td>{$row['sent_by']}</td>
                    <td>{$row['b_name']}</td>
                    <td>{$row['total']}</td>
                    <td>{$row['rnd']}</td>
                    <td>{$row['machinery']}</td>
                    <td>{$row['utilities']}</td>
                    <td>{$row['marketing']}</td>
                    <td>
                        <a href='../funct/approve.php?id={$row['b_id']}' class='btn-update'>Approve</a>
                        <a href='../funct/rejection.php?id={$row['b_id']}' class='btn-delete'>Reject</a>
                    </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No budget requests received</td></tr>";
            }
            ?>

            </tbody>
        </table>
    </div>
</body>
</html>

