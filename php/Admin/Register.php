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
            <a href="Adashboard.php">Go Back</a>
        </div>
        <div class="fld">
            <h2 class="subtitle">Add Users</h2>
        </div>
        <div class="log">
            <p><?php echo "Welcome, " . $_SESSION['username']; ?></p>
        </div>
    </header>
    <div class="container">
    <div class="wrapper">
        <form action="../funct/register.php" method="POST" enctype="multipart/form-data">
            <div class="frm1">
                <div class="input-field">
                    <input type="text" id="fullname" name="fullname" required>
                    <label for="fullname">Full Name</label>
                </div>
                <div class="input-field">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-field">
                    <input type="password" id="password" name="password" required>
                    <label for="password">Password</label>
                </div>
                <div class="input-field">
                    <input type="password" id="confirm-password" name="confirm-password" required>
                    <label for="confirm-password">Confirm Password</label>
                </div>
                <div class="input-field">
                    <input type="file" id="profile_image" name="profile_image">
                </div>
            <button type="submit" value="Upload Image" class="register-btn">Add</button>
            </div>
        </form>
    </div>
    </div>
</body>
</html>
