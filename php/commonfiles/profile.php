<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../commonfiles/login.php");
    exit();
}

include '../funct/connection.php';

$email = $_SESSION['email'];

// Fetch user details
$stmt = $conn->prepare("SELECT fullname, email, image, role FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../../CSS/profile.css"> 
</head>
<body>
    <header>
        <div class="arr">   
            <?php
                if($user['role'] === "admin"){
                    echo '<a href="../Admin/Adashboard.php" class="back-btn">Go Back</a>';
                }else{
                    echo '<a href="../User/Udashboard.php" class="back-btn">Go Back</a>';
                }
            ?>
        </div>
        <div class="fld">
            <h2 class="subtitle">User Profile</h2>
        </div>
        <div class="log">
            <a href="../funct/logout.php" class="logout-btn">Logout</a>
        </div>
    </header>
    <main class="profile-container">
        <h2>Details</h2>
        <hr>
        <div class="pro">
            <div class="profile-card">
                <p><strong>Full Name</strong> <?php echo "<br>" . htmlspecialchars($user['fullname']); ?></p>
                <p><strong>Email</strong> <?php echo "<br>" . htmlspecialchars($user['email']); ?></p>
                <p><strong>Role</strong> <?php echo "<br>" . htmlspecialchars(strtoupper($user['role'])); ?></p>
            </div>
            <div class="pic-class">
                <?php
                if (!empty($user['image'])) {
                    echo '<img src="../../pics/uploads/' . htmlspecialchars($user['image']) . '" alt="User Profile Picture" width="150" height="150">';
                } else {
                    echo '<img src="../../pics/uploads/admin-icon-vector.jpg" alt="Default Profile Picture">';
                }
                ?>
            </div>
        </div> 
        <hr>
    </main>
</body>
</html>
