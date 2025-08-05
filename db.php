<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "busia_alerts"; // Make sure this database exists

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
