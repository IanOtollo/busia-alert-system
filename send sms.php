<?php
require_once 'vendor/autoload.php'; 

use AfricasTalking\SDK\AfricasTalking;

$username = "Sandbox";
$apiKey = "atsk_8655a26be973faf5466f03be1f45286555e991bd83d8abf1d00234f657b1fd428c921b11"; 

$AT = new AfricasTalking($username, $apiKey);
$sms = $AT->sms();

$recipients = ["+254700399641"]; 
$message = "🚨 Test Alert: This is a sandbox SMS from Busia Alert System.";

try {
    $result = $sms->send([
        'to'      => $recipients,
        'message' => $message
    ]);
    echo "✅ SMS sent (check phone):<pre>";
    print_r($result);
    echo "</pre>";
} catch (Exception $e) {
    echo "❌ Failed to send SMS: " . $e->getMessage();
}
?>
