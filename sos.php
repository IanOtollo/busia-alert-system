<?php
include 'db.php';
require_once 'vendor/autoload.php'; 

use AfricasTalking\SDK\AfricasTalking;


$name = $_POST['name'];
$phone = $_POST['phone'];
$ward = $_POST['ward'];
$emergency = $_POST['emergency'];

$stmt = $conn->prepare("INSERT INTO sos_reports (name, phone, ward, emergency) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $phone, $ward, $emergency);

if ($stmt->execute()) {

    $username = "busia-alert-system"; 
    $apiKey   = "atsk_a178c6f7e13133f4718c9d61b1251f559a5cbdd40d8f02b3aee3f28ee8f2358306f0670c"; 
    $AT = new AfricasTalking($username, $apiKey);
    $sms = $AT->sms();

    $adminPhone = "+254700399641"; 
    $message = "🚨 SOS Alert from $name ($ward): $emergency";

    try {
        $sms->send([
            'to' => [$adminPhone],
            'message' => $message
        ]);
    } catch (Exception $e) {
        echo "✅ SOS saved. ⚠️ SMS failed: " . $e->getMessage();
        exit;
    }

    echo "✅ SOS received. Help will be dispatched shortly.<br><a href='index.php'>Back to Home</a>";

} else {
    echo "❌ Failed to submit SOS: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
