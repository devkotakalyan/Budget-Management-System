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
    <title>User Dashboard</title>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav-top">
                    <li><a href="b_ask.php"><i class="material-symbols-rounded">mintmark</i> Ask Budget</a></li>
                    <li><a href="b_stst.php"><i class="material-symbols-rounded">list_alt_check</i> Budget Status</a></li>
                    <li><a href="view_budget.php"><i class="material-symbols-rounded">request_quote</i>View Budget</a></li>
                </ul>
                <ul class="nav-btm">
                    <li><a href="../commonfiles/profile.php"><i class="material-symbols-rounded">person</i> Profile</a></li>
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
                <div class="card1">
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
            </section>
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>
