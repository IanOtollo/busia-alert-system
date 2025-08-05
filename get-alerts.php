<?php
header('Content-Type: application/json');
echo json_encode([
  [
    'type' => 'Test Alert',
    'message' => 'This is a hardcoded alert',
    'latitude' => 0.456,
    'longitude' => 34.108,
    'ward' => 'Test Ward'
  ]
]);
?>
