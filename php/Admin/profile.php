<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../commonfiles/login.php");
    exit();
}

require "../funct/connection.php";

$username = $_SESSION['email'];

$stmt = $conn->prepare("SELECT fullname, email, image ,role FROM users WHERE email = ?");
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
    <link rel="stylesheet" href="../../CSS/profile.css"> 
</head>
<body>
    <main class="profile-container">
        <h2>Profile Details</h2>
        <div class="pro">
        <div class="profile-card">
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['fullname']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Role:</strong> <?php echo htmlspecialchars(strtoupper($user['role'])); ?></p>
        </div>
        <div class="pic-class">
            <img src="../../pics/uploads/"<?php echo htmlspecialchars($user['image']); ?>" alt="Profile Picture" class="profile-pic">
        </div>
        </div>
        <div class="actions">
            <a href="Adashboard.php" class="back-btn">Back to Dashboard</a>
            <a href="../funct/logout.php" class="logout-btn">Logout</a>
        </div>
    </main>
</body>
</html>
