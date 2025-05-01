<?php
include_once "../../database.php";

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

header('Content-Type: application/json');
echo json_encode($reports);
?>