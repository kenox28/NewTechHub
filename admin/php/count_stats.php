<?php
include_once "../../database.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: http://soctech.wuaze.com');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');
// Count total users from account table
$users_query = mysqli_query($connect, "SELECT COUNT(*) as total_users FROM account");
$users_result = mysqli_fetch_assoc($users_query);
$total_users = $users_result['total_users'];

// Count total posts from newsfeed table
$posts_query = mysqli_query($connect, "SELECT COUNT(*) as total_posts FROM newsfeed");
$posts_result = mysqli_fetch_assoc($posts_query);
$total_posts = $posts_result['total_posts'];

// Count total reports from reportmessage table
$reports_query = mysqli_query($connect, "SELECT COUNT(*) as total_reports FROM reportmessage");
$reports_result = mysqli_fetch_assoc($reports_query);
$total_reports = $reports_result['total_reports'];

// Count total feedback from feedbackmessage table
$feedback_query = mysqli_query($connect, "SELECT COUNT(*) as total_feedback FROM feedbackmessage");
$feedback_result = mysqli_fetch_assoc($feedback_query);
$total_feedback = $feedback_result['total_feedback'];

// Prepare result array
$result = array(
    'total_users' => $total_users,
    'total_posts' => $total_posts,
    'total_reports' => $total_reports,
    'total_feedback' => $total_feedback
);

// Return JSON response
header('Content-Type: application/json');
echo json_encode($result);
?>