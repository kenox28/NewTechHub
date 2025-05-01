<?php
include_once "../../database.php";

// Check if user ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'User ID is required']);
    exit;
}

$userId = mysqli_real_escape_string($connect, $_GET['id']);

// Delete the report
$deleteQuery = "DELETE FROM reportmessage WHERE id = '$userId'";
$result = mysqli_query($connect, $deleteQuery);

if ($result) {
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Report deleted successfully']);
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Failed to delete report: ' . mysqli_error($connect)]);
}
?>