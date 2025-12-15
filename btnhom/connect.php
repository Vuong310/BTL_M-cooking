<?php
$servername = "localhost";
$userName = "root";
$password = "Tamihaya198";
$database = "quan_ly_web_nauan";

// Create connection
$conn = new mysqli($servername, $userName, $password, $database);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>