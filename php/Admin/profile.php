<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../commonfiles/login.php"); // Redirect to login page if not logged in
    exit();
}

require "../funct/connection.php";

// Retrieve the user's information based on their email or username stored in the session
$username = $_SESSION['email'];

$stmt = $conn->prepare("SELECT fullname, email, role FROM users WHERE email = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../../CSS/profile.css"> <!-- Add your custom CSS file -->
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($user['fullname']); ?></h1>
        <a href="../funct/logout.php" class="logout-btn">Logout</a>

    </header>
    <main class="profile-container">
        <div class="profile-card">
            <h2>Profile Details</h2>
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['fullname']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
        </div>
        <div class="actions">
            <a href="Adashboard.php" class="back-btn">Back to Dashboard</a>
        </div>
    </main>
</body>
</html>
