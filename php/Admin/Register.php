<?php

session_start();

include '../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $role = "user";
    
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $name, $email, $pass, $role);

    if ($stmt->execute()) {
            echo "<script>alert('User Added Successfully!'); window.location.href='userlist.php'</script>;";
        exit();
    } else {
        echo "Try again";
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
    <title>Register Form</title>
    <link rel="stylesheet" href="../../CSS/register.css">
</head>
<body>
    <header>
        <div class="arr">
            <a href="userlist.php">Go Back</a>
        </div>
        <div class="fld">
            <h1>Budget Management</h1>
            <!-- <p>Track and manage your budget effectively</p> -->
        </div>
        <div class="log">
        <p><?php echo "Welcome ". $_SESSION['username'] ?></p>
        </div>
    </header>
    <div class="form-container">
        <form class="register-form" action="" method="POST">
            <h2>Add User</h2>
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" placeholder="Enter User's full name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter User's email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create a password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="register-btn">Add</button>
            <!-- <p>Already have an account? <a href="login.php">Login here</a></p> -->
        </form>
    </div>
</body>
</html>
