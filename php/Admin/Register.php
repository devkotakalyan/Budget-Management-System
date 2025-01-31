<?php

    session_start();

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
        </div>
        <div class="log">
            <p><?php echo "Welcome ". htmlspecialchars($_SESSION['username']); ?></p>
        </div>
    </header>

    <div class="form-container">
        <form class="register-form" action="../funct/register.php" method="POST" enctype="multipart/form-data">
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
            <div class="form-group">
                <label for="profile_image">Upload Profile Picture</label>
                <input type="file" id="profile_image" name="profile_image">
            </div>
            <button type="submit" value="Upload Image" class="register-btn">Add</button>
        </form>
    </div>
</body>
</html>
