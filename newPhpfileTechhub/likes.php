<?php
session_start();
include_once "../database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userid']) && isset($_POST['vote'])) {
    $postId = $_POST['userid'];
    $voteType = $_POST['vote'];
    
    // Check if user has already voted on this post
    if (isset($_SESSION['up_' . $postId]) || isset($_SESSION['down_' . $postId])) {
        echo json_encode(['success' => false, 'message' => 'Already voted']);
        exit;
    }
    
    // Update the react count based on vote type
    $updateQuery = "UPDATE newsfeed SET react = react " . ($voteType === 'up' ? '+1' : '-1') . " WHERE id = ?";
    $stmt = $connect->prepare($updateQuery);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    
    // Get the updated react count
    $selectQuery = "SELECT react FROM newsfeed WHERE id = ?";
    $stmt = $connect->prepare($selectQuery);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $stmt->close();
    
    // Mark this post as voted in the session
    $_SESSION[$voteType . '_' . $postId] = true;
    
    echo json_encode(['success' => true, 'newCount' => $row['react']]);
} else {
    echo json_encode(['success' => false]);
}
?>