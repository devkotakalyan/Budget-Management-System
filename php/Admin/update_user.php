<?php
session_start();
require "../funct/connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch existing user data
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('No User found with the given ID.'); window.history.back();</script>";
        exit;
    }
} else {
    echo "<script>alert('No ID provided.'); window.history.back();</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $safeEmail = preg_replace('/[^a-zA-Z0-9]/', '_', $email); // Sanitize email for folder name

    // Retrieve the existing image
    $stmt = $conn->prepare("SELECT image FROM users WHERE id = ?"); 
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $existingData = $result->fetch_assoc();
    $old_image = $existingData['image']; // Keep the old image if no new image is uploaded

    // Define user folder path
    $userFolder = __DIR__ . "/../../pics/uploads/" . $safeEmail . "/";

    // Image Upload Handling
    if (!empty($_FILES['profile_image']['name'])) {
        $new_image = basename($_FILES['profile_image']['name']);
        $target_file = $userFolder . $new_image;

        // Move uploaded file
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            // Delete old image if it's not the default one
            if ($old_image !== "user.jpg" && file_exists($userFolder . $old_image)) {
                unlink($userFolder . $old_image);
            }
            $profile_image = $safeEmail . "/" . $new_image; // Store relative path
        } else {
            echo "<script>alert('Error uploading image.'); window.history.back();</script>";
            exit;
        }
    } else {
        $profile_image = $old_image; // Keep the existing image if no new image is uploaded
    }

    // Update Query
    $stmt = $conn->prepare("UPDATE users SET fullname = ?, email = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $email, $profile_image, $id);

    if ($stmt->execute()) {
        echo "<script>alert('User updated successfully!'); window.location.href = 'userlist.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="../../CSS/register.css">
    <script src="../../js/res_val.js"></script>
</head>
<body>
    <header>
        <div class="arr">
            <a href="userlist.php">Go Back</a>
        </div>
        <div class="fld">
            <h2 class="subtitle">Update User</h2>
        </div>
        <div class="log">
            <p><?php echo "Welcome, " . $_SESSION['username']; ?></p>
        </div>
    </header>
    <div class="container">
        <div class="wrapper">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="frm1">
                    <div class="input-field">
                        <input type="text" id="fullname" name="fullname" value="<?php echo $row['fullname']; ?>" required>
                        <label for="fullname">Full Name</label>
                    </div>
                    <div class="input-field">
                        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field">
                        <input type="password" id="password" name="password">
                        <label for="password">New Password (leave blank to keep current)</label>
                    </div>
                    <div class="input-field">
                        <input type="password" id="confirm-password" name="confirm-password">
                        <label for="confirm-password">Confirm New Password</label>
                    </div>
                    <div class="input-field">
                        <p>Current Image:<br><img src="../../pics/uploads/<?php echo $row['image']; ?>" width="100" height="100" alt="Profile Image"></p><br>
                        <input type="file" id="profile_image" name="profile_image">
                    </div>
                    <button type="submit" class="register-btn">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
