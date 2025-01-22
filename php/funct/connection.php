<?php
$servername="localhost: 3309";
$username ="root";
$password="";
$functname="budgetmanagement";

$conn = mysqli_connect($servername,$username,$password,$functname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

