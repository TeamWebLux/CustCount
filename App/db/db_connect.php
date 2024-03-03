<?php
$servername = "localhost"; // or your server name
$username = "root";
$password = "";
$dbname = "financy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    // echo "success";
}
?>
