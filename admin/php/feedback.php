<?php
include_once "../../database.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: http://soctech.wuaze.com');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');
$sql = mysqli_query($connect, "SELECT * FROM feedbackmessage");

$reports = [];

while ($reportData = mysqli_fetch_assoc($sql)) {
    // Format report data for the dashboard
    // No status is needed as per requirement

    $reports[] = [
        'id' => $reportData['id'], 
        'type' => 'message', 
        'content' => $reportData['feedback'],
        'sender' => $reportData['fname'],
        'rate' => $reportData['rating'],
        'date' => date('Y-m-d'),
        'userid' => $reportData['userid']
    ];
}

header('Content-Type: application/json');
echo json_encode($reports);
?>