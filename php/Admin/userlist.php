<?php

require "../connection.php";

// Fetch all users
$sql = "SELECT id, fullname, email, role FROM users where role = 'user'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="../../CSS/userslist.css">
</head>
<body>
<header>
        <div class="arr">
            <a href="Dashboard.html">Go Back</a>
        </div>
        <div class="fld">
            <h1>Budget Management</h1>
            <!-- <p>Track and manage your budget effectively</p> -->
        </div>
        <div class="log">
            <p>Welcome ${User}</p>
        </div>
    </header>
    <div class="user-list-container">
        <h2>User List</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
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
                                <td>{$row['role']}</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
