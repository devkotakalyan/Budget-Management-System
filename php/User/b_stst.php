<?php

    session_start();

    require "../funct/connection.php";

    $sql = "SELECT * FROM stored_budgets WHERE status IN ('Approved', 'Rejected')";
    $sqli = "SELECT * FROM asked_budgets";
    $result = $conn->query($sql);
    $res = $conn->query($sqli);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Status</title>
    <link rel="stylesheet" href="../../CSS/userslist.css">
</head>
<body>
    <header>
        <div class="arr">
            <a href="Udashboard.php">Go Back</a>
        </div>
        <div class="fld">
            <h2 class="subtitle">Budget Status</h2>
        </div>
        <div class="log">
            <p><?php echo "Welcome, " . $_SESSION['username']; ?></p>
        </div>
    </header>
    <div class="container">
        <div class="tbl1">
        <h2>Budget Report</h2>
    <table class="user-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Total</th>
            <th>R&D</th>
            <th>Machinery</th>
            <th>Utilities</th>
            <th>Marketing</th>
            <th>Remaining</th>
            <th>Status</th>
        </tr>
    </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $statusColor = ($row['status'] === 'Approved') ? 'status-approved' : 'status-rejected';
                echo "<tr>
                    <td>{$row['b_id']}</td>
                    <td>{$row['b_name']}</td>
                    <td>{$row['total']}</td>
                    <td>{$row['rnd']}</td>
                    <td>{$row['machinery']}</td>
                    <td>{$row['utilities']}</td>
                    <td>{$row['marketing']}</td>
                    <td>{$row['rem']}</td>
                    <td class='$statusColor'>{$row['status']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No budgets found</td></tr>";
        }
        ?>
        </tbody>
    </table>

        </div>
        <div class="tbl2">
        <h2>Budget Quote</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>S.ID</th>
                    <th>Name</th>
                    <th>Total</th>
                    <th>R&D</th>
                    <th>Machinery</th>
                    <th>Utilities</th>
                    <th>Marketing</th>
                    <th>Remaining</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) { 
                        echo "<tr>
                            <td>{$row['b_id']}</td>
                            <td>{$row['b_name']}</td>
                            <td>{$row['total']}</td>
                            <td>{$row['rnd']}</td>
                            <td>{$row['machinery']}</td>
                            <td>{$row['utilities']}</td>
                            <td>{$row['marketing']}</td>
                            <td>{$row['rem']}</td>
                            <td>Pending</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No budgets found</td></tr>";
                }
            ?>
            </tbody>
        </div>
    </table>
    </div>    
</body>
</html>