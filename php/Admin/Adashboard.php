<?php

    session_start();

    require "../funct/connection.php";

    $sql = "SELECT b_name, total FROM budgets";
    $result = $conn->query($sql);

    $sqli = "SELECT b_name, total FROM asked_budgets";
    $res = $conn->query($sqli);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Management</title>
    <link rel="stylesheet" href="../../CSS/dash.css">       
</head>
<body>
    <header>
        <div class="fld">
            <h1>Budget Management</h1>
            <p>Track and manage your budget effectively</p>
        </div>
        <div class="log">
            <p><?php echo "Welcome " . $_SESSION['username']; ?></p>
        </div>
    </header>
    <div class="body">
        <div class="sidebar">
            <div class="nav">
                <a href="budget_alloc.php"><p>Allocate Budget</p></a>
                <a href="userlist.php"><p>User List</p></a>
                <a href="budgets.php"><p>All Budgets</p></a>
                <a href="budgets_req.php"><p>Budget Request</p></a>
            </div>
            <div class="ter">
                <p><a href="profile.php">View Profile</a></p>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <h3>Ongoing Budgets</h3>
                <hr>
                    <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<p><strong>{$row['b_name']}</strong></p>";
                                echo "<p><strong>Total Budget: Rs {$row['total']}</strong></p>";
                                echo "<hr>";
                            }
                            } else {
                                echo "<p>No ongoing budgets found.</p>";
                            }
                    ?>
            </div>  
        </div>
        <div class="container">
            <div class="card">
                <h3>Requested budgets </h3>
                <hr>
                    <?php
                        if ($res->num_rows > 0) {
                            while ($row = $res->fetch_assoc()) {
                                echo "<p><strong>{$row['b_name']}</strong></p>";
                                echo "<p><strong>Total Budget: Rs {$row['total']}</strong></p>";
                                echo "<hr>";
                            }
                            } else {
                                echo "<p>No Budget Requests Sent</p>";
                        }
                    ?>
            </div>  
        </div>
    </div>
</body>
</html>
