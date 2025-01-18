<?php

    session_start();

    require "../db/connection.php";


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
                <a href="#"><p>Ask Budget</p></a>
                <a href="#"><p>Update Request</p></a>
                <a href="#"><p>Sub divide Budget</p></a>
            </div>
            <div class="ter">
                <a href="../login.php"><p>Log out</p></a>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <h3>Total Budget</h3>
                <p><strong>$5000</strong></p>
            </div>
    
            <div class="card">
                <h3>Budget Allocation</h3>
                <p>Rent: $2000</p>
                <div class="progress-bar">
                    <div style="width: 40%;">40%</div>
                </div>
    
                <p>Groceries: $1000</p>
                <div class="progress-bar">
                    <div style="width: 20%;">20%</div>
                </div>
    
                <p>Utilities: $500</p>
                <div class="progress-bar">
                    <div style="width: 10%;">10%</div>
                </div>
    
                <p>Entertainment: $500</p>
                <div class="progress-bar">
                    <div style="width: 10%;">10%</div>
                </div>
    
                <p>Savings: $1000</p>
                <div class="progress-bar">
                    <div style="width: 20%;">20%</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
