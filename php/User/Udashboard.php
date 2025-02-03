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
        <header>
            <div class="fld">
                <h2 class="subtitle">Budget Management System</h2>
                <p>Manage your Budget</p>
            </div>
            <div class="log">
                <p><?php echo "Welcome, " . $_SESSION['username']; ?></p>
            </div>
        </header>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav-top">
                    <li><a href="b_ask.php"><i class="material-symbols-rounded">mintmark</i> Ask Budget</a></li>
                    <li><a href="b_stst.php"><i class="material-symbols-rounded">list_alt_check</i> Budget Status</a></li>
                    <li><a href="view_budget.php"><i class="material-symbols-rounded">request_quote</i>View Budget</a></li>
                    <li><a href="send_rev.php"><i class="material-symbols-rounded">post_add</i>Send Review</a></li>
                    <li><a href="review.php"><i class="material-symbols-rounded">reviews</i>See Review</a></li>
                </ul>
                <ul class="nav-btm">
                    <li><a href="../commonfiles/profile.php"><i class="material-symbols-rounded">person</i> Profile</a></li>
                </ul>
            </nav>
        </aside>
        <main>
            <section class="dashboard">
                <div class="card3">
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
