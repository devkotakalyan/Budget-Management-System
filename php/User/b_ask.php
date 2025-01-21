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

    $stmt = $conn->prepare("INSERT INTO asked_budgets (b_name, total, rnd, machinery, utilities, marketing) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sddddd", $budgetName, $totalBudget, $rnd, $machinery, $utilities, $marketing);

    if ($stmt->execute()) {
        echo "
        <script>
            alert('Budget Asked');
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="../../CSS/budget_alloc.css">
</head>
<body>
<header>
        <div class="arr">
            <a href="../User/Udashboard.php">Go Back</a>
        </div>
        <div class="fld">
            <h1>Budget Management</h1>
            <p>Ask New Budget</p>
        </div>
        <div class="log">
            <p><?php echo "Welcome ". $_SESSION['username'] ?></p>
        </div>
    </header>
    <div class="allocation-container">
        <form method="POST" action="">
            <div class="form-group">
                <label for="Budgetname">Name of Budget</label>
                <input type="text" name="name" id="Budgetname"  required>
            </div>
            <div class="form-group">
                <label for="totalBudget">Total Budget:</label>
                <input type="number" name="total" id="totalBudget"  required>
            </div>
            <div class="form-group">
                <label for="R&D">R&D:</label>
                <input type="number" name="R&D" id="R&D">
            </div>
            <div class="form-group">
                <label for="Machinery">Machinery:</label>
                <input type="number" name="Machinery" id="Machinery">
            </div>
            <div class="form-group">
                <label for="utilities">Utilities:</label>
                <input type="number" name="utilities" id="utilities">
            </div>
            <div class="form-group">
                <label for="Marketing">Marketing:</label>
                <input type="number" name="Marketing" id="Marketing">
            </div>
            <button type="submit" class="allocate-btn">Ask Budget</button>
        </form>
    </div>
</body>
</html>

