<?php
include 'db.php';

$type = $_POST['type'];
$location = $_POST['location'];
$message = $_POST['message'];
$lat = !empty($_POST['lat']) ? $_POST['lat'] : null;
$lng = !empty($_POST['lng']) ? $_POST['lng'] : null;

$admin_key = $_POST['admin_key'];
$allowed_key = "BSA040";  

if ($admin_key !== $allowed_key) {
  die("❌ Unauthorized: Incorrect admin key.");
}

$stmt = $conn->prepare("INSERT INTO alerts (type, location, message, lat, lng) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssdd", $type, $location, $message, $lat, $lng);

if ($stmt->execute()) {
  echo "✅ Alert posted successfully.<br><a href='alerts.php'>View Alerts</a>";
} else {
  echo "❌ Failed to post alert: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
