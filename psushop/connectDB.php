<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "psushop";

// Create connection
$conn = new mysqli($servername, $username, $password ,$database);
// $conn -> set_charset("utf8");
mysqli_set_charset($conn, "utf8");
// Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
// ?>