<?php

session_start();

require "../funct/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $budgetName = $_POST['name'];
    $totalBudget = $_POST['total'];
    $rnd = $_POST['R&D'] ?? 0;  
    $machinery = $_POST['Machinery'] ?? 0; 
    $utilities = $_POST['utilities'] ?? 0; 
    $marketing = $_POST['Marketing'] ?? 0; 
    $rem = $_POST['rem'] ?? 0; 
    $sent_by = $_SESSION['email'];

    $totalBudget = floatval($totalBudget);
    $rnd = floatval($rnd);
    $machinery = floatval($machinery);
    $utilities = floatval($utilities);
    $marketing = floatval($marketing);
    $rem = floatval($rem);

    $stmt = $conn->prepare("INSERT INTO asked_budgets (sent_by, b_name, total, rnd, machinery, utilities, marketing, rem) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param("ssdddddd", $sent_by, $budgetName, $totalBudget, $rnd, $machinery, $utilities, $marketing, $rem);

    if ($stmt->execute()) {
        echo "
        <script>
            alert('Budget Asked');
            window.location.href = 'Udashboard.php';
        </script>";

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask Budget</title>
    <link rel="stylesheet" href="../../CSS/budget_alloc.css">
    <script src="../../js/bud_alloc.js"></script>

</head>
<body>
    <header>
        <div class="arr">
            <a href="Udashboard.php">Go Back</a>
        </div>
        <div class="fld">
            <h2 class="subtitle">Ask a Budget</h2>
        </div>
        <div class="log">
            <p><?php echo "Welcome, " . $_SESSION['username']; ?></p>
        </div>
    </header>
    <div class="container">
    <div class="wrapper">
            <form method="POST" action="">

                <div class="frm1">
                    <div class="input-field">
                        <input type="text" name="name" id="Budgetname" required>
                        <label for="Budgetname">Name of Budget</label>
                    </div>

                    <div class="input-field">
                        <input type="number" name="total" id="totalBudget" required>
                        <label for="totalBudget">Total Budget</label>
                    </div>
                </div>
                
                <div class="frm2">
                    <div class="input-field">
                        <input type="number" name="R&D" id="R&D" required>
                        <label for="R&D">R&D</label>
                    </div>

                    <div class="input-field">
                        <input type="number" name="Machinery" id="Machinery" required>
                        <label for="Machinery">Machinery</label>
                    </div>

                    <div class="input-field">
                        <input type="number" name="utilities" id="utilities" required>
                        <label for="utilities">Utilities</label>
                    </div>

                    <div class="input-field">
                        <input type="number" name="Marketing" id="Marketing" required>
                        <label for="Marketing">Marketing</label>
                    </div>
                    <input type="number" hidden name="rem" id="rem_amt">
                </div>
                <button type="submit">Ask Budget</button>
            </form>
            <div class="alert">
                <p id="error">This is error</p>
            </div>
        </div>
    </div>
</body>
</html>

