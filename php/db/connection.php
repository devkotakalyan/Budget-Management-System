<?php
$servername="localhost: 3309";
$username ="root";
$password="";
$dbname="budgetmanagement";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

