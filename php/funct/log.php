<?php

    session_start();

    require "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validate user credentials
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = ?");
    $stmt->bind_param('ss', $username, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $fullname = $user['fullname'];
        $email = $user['email'];
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $fullname;

        if ($password === $user['password']) {
            if ($role === 'admin') {
                header("Location: ../Admin/Adashboard.php");
            } else {
                header("Location: ../User/Udashboard.php");
            }
            exit();
        } else {
            echo 
            "<script>
                alert('Invalid Password');
                window.location.href = '../commonfiles/login.php';
            </script>";
        }
    } else {
        echo 
        "<script>
            alert('Invalid Role or Username Provided');
            window.location.href = '../commonfiles/login.php';
        </script>";
        
    }

    $stmt->close();
    $conn->close();
}
?>
