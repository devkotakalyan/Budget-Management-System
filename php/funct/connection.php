

<?php
$servername = 'localhost: 3309';
$username = 'root';
$password = ""; 
$functname = 'budgetmanag';


$conn = mysqli_connect($servername, $username, $password, $functname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

