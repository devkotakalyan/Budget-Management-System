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
            <form id="form" action="../db/log.php" method="post">
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
