<?php
include 'db.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$ward = $_POST['ward'];

if ($name && $phone && $ward) {
  $stmt = $conn->prepare("INSERT INTO users (name, phone, ward) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $phone, $ward);
  
  if ($stmt->execute()) {
    echo "✅ Subscription successful!";
  } else {
    echo "❌ Failed to subscribe: " . $conn->error;
  }
  $stmt->close();
} else {
  echo "Please fill in all fields.";
}

$conn->close();
?>
