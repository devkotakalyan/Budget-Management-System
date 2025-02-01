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

    $totalBudget = floatval($totalBudget);
    $rnd = floatval($rnd);
    $machinery = floatval($machinery);
    $utilities = floatval($utilities);
    $marketing = floatval($marketing);

    $stmt = $conn->prepare("INSERT INTO budgets (b_name, total, rnd, machinery, utilities, marketing) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sddddd", $budgetName, $totalBudget, $rnd, $machinery, $utilities, $marketing);

    if ($stmt->execute()) {
        echo "
        <script>
            alert('Budget Allocated');
            window.location.href = 'budgets.php';
        </script>";

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../../CSS/budget_alloc.css">
</head>
<body>
    <header>
        <div class="arr">
            <a href="Adashboard.php">← Go Back</a>
        </div>
        <div class="fld">
            <h2 class="subtitle">Make a Budget</h2>
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
                </div>
                <button type="submit">Allocate Budget</button>
            </form>
        </div>
    </div>
</body>
</html>

