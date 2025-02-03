<?php

session_start();

require "../funct/connection.php";

// Fetch all users
$sql = "SELECT * FROM users where role = 'user'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="../../CSS/userslist.css">
</head>
<body>
    <header>
        <div class="arr">
            <a href="Adashboard.php">Go Back</a>
        </div>
        <div class="fld">
            <h2 class="subtitle">Users list</h2>
        </div>
        <div class="log">
            <p><?php echo "Welcome, " . $_SESSION['username']; ?></p>
        </div>
    </header>
    <div class="wrapper">
            <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>   
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['fullname']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['password']}</td>
                                <td>{$row['role']}</td>
                                <td><img src='../../pics/uploads/{$row['image']}' alt='Profile Image'></td>
                                <td>
                                    <a href='update_user.php?id={$row['id']}' class='btn-update'>Update</a>
                                    <a href='../funct/deluser.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\"Are you sure you want to delete this budget?\")'>Delete</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No users found</td></tr>";
                }
                ?>
            </tbody>
            </table>
            <div class="add">
                <a href="Register.php">Add Users</a>
            </div>
    </div>    
</body>
</html>

<?php
$conn->close();
?>
