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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/dash.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet">
    <title>Admin Dashboard</title>
</head>
<body style="background: linear-gradient(to right, rgba(185, 180, 180, 0.5), rgba(27, 26, 26, 0.5)), url('../../pics/user_background.jpg') no-repeat center/cover;">
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav-top">
                    <li><a href="budget_alloc.php"><i class="material-symbols-rounded">add_box</i> Allocate Budget</a></li>
                    <li><a href="budgets.php"><i class="material-symbols-rounded">contract</i> All Budget</a></li>
                    <li><a href="budgets_req.php"><i class="material-symbols-rounded">request_quote</i> Budget Requests</a></li>
                    <li><a href="userlist.php"><i class="material-symbols-rounded">group</i> User List</a></li>
                </ul>
                <ul class="nav-btm">
                    <li><a href="profile.php"><i class="material-symbols-rounded">person</i> Profile</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <header class="main-header">
                <div class="title">
                    <h1>Budget Management</h1>
                    <p>Track and manage your budget effectively</p>
                </div>
                <div class="welcome">
                    <p>Welcome, <span><?php echo $_SESSION['username']; ?></span></p>
                </div>
            </header>
            <section class="dashboard">
                <div class="card">
                    <h3>Ongoing Budgets</h3>
                    <hr>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<p><strong>{$row['b_name']}</strong></p>";
                            echo "<p>Total Budget: Rs {$row['total']}</p>";
                            echo "<hr>";
                        }
                    } else {
                        echo "<p>No ongoing budgets found.</p>";
                    }
                    ?>
                </div>

                <div class="card">
                    <h3>Requested Budgets</h3>
                    <hr>
                    <?php
                    if ($res->num_rows > 0) {
                        while ($row = $res->fetch_assoc()) {
                            echo "<p><strong>{$row['b_name']}</strong></p>";
                            echo "<p>Total Budget: Rs {$row['total']}</p>";
                            echo "<hr>";
                        }
                    } else {
                        echo "<p>No budget requests sent.</p>";
                    }
                    ?>
                </div>
            </section>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>


