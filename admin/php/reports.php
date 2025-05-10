<?php
include_once "../../database.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: http://soctech.wuaze.com');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');
$sql = mysqli_query($connect, "SELECT * FROM reportmessage");

$reports = [];

while ($reportData = mysqli_fetch_assoc($sql)) {
    // Format report data for the dashboard
    // No status is needed as per requirement

    $reports[] = [
        'id' => $reportData['id'], // You might have a specific report ID field
        'type' => 'Report', // You might have a specific type field
        'content' => $reportData['report'],
        'reporter' => $reportData['fname'],
        'date' => date('Y-m-d'), // You might have a date field in your database
        'userid' => $reportData['userid']
    ];
}

echo json_encode($reports);
?>