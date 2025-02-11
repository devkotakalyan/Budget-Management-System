<?php
session_start();
require "../funct/connection.php";

// Fetch all user reviews
$sql = "SELECT * FROM user_review ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
    <link rel="stylesheet" href="../../CSS/budget_alloc.css">
</head>
<body>
    <header>
        <div class="arr">
            <a href="Adashboard.php">Go Back</a>
        </div>
        <div class="fld">
            <h2 class="subtitle">User Reviews</h2>
        </div>
        <div class="log">
            <p><?php echo "Welcome, " . $_SESSION['username']; ?></p>
        </div>
    </header>

    <div class="container">
            <?php
            // Check if there are reviews in the database
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='review'>";
                    echo "<div class='review-box'>";
                    echo "<h3>Review by: <span>{$row['sent_by']}</span> <a href='../funct/del_rev.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\"Are you sure you want to delete this budget?\")'>Delete</a></h3>";
                    echo "<br>";
                    echo "<p>{$row['review']}</p>";
                    echo "</div>";
                    echo "</div>";
                    }
            } else {
                echo "<div class='review'>";
                echo "<div class='review-box'>";
                echo "<p>No reviews found.</p>";
                echo "</div>";
                echo "</div>";
            }
            ?>
    </div>
</body>
</html>
