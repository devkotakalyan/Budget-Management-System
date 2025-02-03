

<?php
$servername = 'localhost';
$username = 'root';
$password = ""; 
$functname = 'budgetmanagement';


$conn = mysqli_connect($servername, $username, $password, $functname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

