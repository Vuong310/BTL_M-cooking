<?php
$servername = "localhost";
$username = "root";
$password = "30122005";
$database = "quan_ly_web_nauan";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>