<?php
session_start();
require "../funct/connection.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $review = $conn->real_escape_string($_POST['review_content']);

    // Insert review into database
    $sql = "INSERT INTO user_review (sent_by, review) VALUES ('$email', '$review')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Review submitted successfully!'); window.location.href='Udashboard.php';</script>";
    } else {
        echo "<script>alert('Error submitting review.');</script>";
    }
}
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
            <a href="Udashboard.php">Go Back</a>    
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
            <form action="" method="POST">
                <label>Write Your Review</label>
                <div class="input-field">
                    <textarea name="review_content" required></textarea>
                </div>
                <button type="submit">Send To Admin</button>
            </form>
        </div>
    </div> 
</body>
</html>
