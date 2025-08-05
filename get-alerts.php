<?php
header('Content-Type: application/json');
include 'db.php'; // Use your existing DB connection script

$sql = "SELECT type, message, latitude, longitude, ward FROM alerts ORDER BY date DESC";
$result = $conn->query($sql);

$alerts = [];
while ($row = $result->fetch_assoc()) {
    $alerts[] = $row;
}
echo json_encode($alerts);
$conn->close();
?>
