<?php

    session_start();

    require "../db/connection.php";

    $sql = "SELECT b_name, total FROM budgets";
    $result = $conn->query($sql);


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
            <p>Track and View your budget effectively</p>
        </div>
        <div class="log">
            <p>Welcome <?php echo $_SESSION['username']; ?></p>
        </div>
    </header>
    <div class="body">
        <div class="sidebar">
            <div class="nav">
                <a href="view_budget.php"><p>View Budget</p></a>
                <a href="b_ask.php"><p>Ask Budget</p></a>
                <a href="#"><p>Update Request</p></a>
                <a href="#"><p>Sub divide Budget</p></a>
            </div>
            <div class="ter">
                <a href="../commonfiles/login.php"><p>Log out</p></a>
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
    </div>
</body>
</html>
