<?php

    session_start();

    require "../funct/connection.php";

    $sql = "SELECT * FROM budgets ";
    $result = $conn->query($sql);

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
            <a href="../Admin/Adashboard.php">Go Back</a>
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
                    <th>Delete/Update</th>
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
                    <td>
                        <a href='budget_update.php?id={$row['b_id']}' class='btn-update'>Update</a>
                        <a href='../funct/deletion.php?id={$row['b_id']}' class='btn-delete' onclick='return confirm(\"Are you sure you want to delete this budget?\")'>Delete</a>
                    </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No budgets found <a href='budget_alloc.php' class='btn-update'>Create Budgets</a></td></tr>";
            }
            ?>

            </tbody>
        </table>
    </div>
</body>
</html>

