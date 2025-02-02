<?php

session_start();

require "../funct/connection.php";

// Check if an ID is passed and fetch the current budget details
if (isset($_GET['id'])) {
    $b_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM budgets WHERE b_id = ?");
    $stmt->bind_param("i", $b_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No budget found with the given ID.";
        exit;
    }
} else {
    echo "No ID provided.";
    exit;
}

// Handle form submission to update the budget
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $budgetName = $_POST['name'];
    $totalBudget = $_POST['total'];
    $rnd = $_POST['R&D'] ?? 0;
    $machinery = $_POST['Machinery'] ?? 0;
    $utilities = $_POST['utilities'] ?? 0;
    $marketing = $_POST['Marketing'] ?? 0;

    $stmt = $conn->prepare(
        "UPDATE budgets SET b_name = ?, total = ?, rnd = ?, machinery = ?, utilities = ?, marketing = ? WHERE b_id = ?"
    );
    $stmt->bind_param("sdddddi", $budgetName, $totalBudget, $rnd, $machinery, $utilities, $marketing, $b_id);

    if ($stmt->execute()) {
        echo "<script>alert('Budget updated successfully!'); window.location.href='budgets.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Budget</title>
    <link rel="stylesheet" href="../../CSS/budget_alloc.css">
</head>
<body>
    <header>
        <div class="arr">
            <a href="Adashboard.php">Go Back</a>
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
                    <input type="text" name="name" id="Budgetname" value="<?php echo $row['b_name']; ?>" required>
                    <label for="Budgetname">Name of Budget</label>
                </div>
                <div class="input-field">
                    <input type="number" name="total" id="totalBudget" value="<?php echo $row['total']; ?>" required>
                    <label for="totalBudget">Total Budget:</label>
                </div>
            </div>
            <div class="frm2">
                <div class="input-field">
                    <input type="number" name="R&D" id="R&D" value="<?php echo $row['rnd']; ?>">
                    <label for="R&D">R&D:</label>
                </div>
                <div class="input-field">
                    <input type="number" name="Machinery" id="Machinery" value="<?php echo $row['machinery']; ?>">
                    <label for="Machinery">Machinery:</label>
                </div>
                <div class="input-field">
                    <input type="number" name="utilities" id="utilities" value="<?php echo $row['utilities']; ?>">
                    <label for="utilities">Utilities:</label>
                </div>
                <div class="input-field">
                    <input type="number" name="Marketing" id="Marketing" value="<?php echo $row['marketing']; ?>">
                    <label for="Marketing">Marketing:</label>
                </div>
            </div>            
            <button type="submit" class="allocate-btn">Update Budget</button>
        </form>
        </div>
    </div>
</body>
</html>
