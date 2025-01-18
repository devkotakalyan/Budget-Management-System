<?php
session_start();

require "../db/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $_SESSION['username'] = $_POST['username'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = ?");
    $stmt->bind_param('ss', $username, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($password === $user['password']) {
            if ($role === 'admin') {
                header("Location: ../Admin/Adashboard.php");
            } else {
                header("Location: ../User/Udashboard.php");
            }
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Invalid username or role.";
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
    <title>Login Page</title>
    <link rel="stylesheet" href="../../CSS/login.css">
</head>
<body>
    <header>
        <h1>Budget Management System</h1>
        <!-- <p>Please log in to access your account</p> -->
    </header>
    <div class="login-container">
        <div class="login-card">
            <h2>Login</h2>
            <form id="form" action="" method="post">
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" id="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Enter your Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="rem_me">
                    <input type="checkbox" id="remember_me" name="remember_me">
                    <label for="remember_me">Remember me</label>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
            Not a user? <a href="Register.php">Register With us</a>
        </div>
    </div>
</body>
</html>
