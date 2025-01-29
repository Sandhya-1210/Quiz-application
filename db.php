<?php
$servername = "localhost";  // Replace with your MySQL server name
$username = "rootlocalhost";     // Replace with your MySQL username
$password = "Sandhya@12";     // Replace with your MySQL password
$dbname = "quiz_db";        // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
