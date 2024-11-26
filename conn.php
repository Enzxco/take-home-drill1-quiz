<?php
$servername = "localhost";
$username = "root";   // your MySQL username
$password = "root";   // your MySQL password
$dbname = "quiz_db";  // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
