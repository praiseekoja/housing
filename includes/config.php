<?php
// config.php - Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "house_man_sys";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
