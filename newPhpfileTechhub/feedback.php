<?php
include "../database.php";

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request method');
}

// Get and validate inputs
$feedback_message = isset($_POST['feedback_message']) ? mysqli_real_escape_string($connect, $_POST['feedback_message']) : '';
$rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
$feedback_sender = isset($_POST['feedback_sender']) ? mysqli_real_escape_string($connect, $_POST['feedback_sender']) : '';

// Debug
error_log("Received data - Message: $feedback_message, Rating: $rating, Sender: $feedback_sender");

if (!empty($feedback_message) && $rating > 0 && !empty($feedback_sender)) {
    // Get user details
    $sql = mysqli_query($connect, "SELECT * FROM account WHERE userid = '$feedback_sender'");
    
    if (!$sql) {
        error_log("User query error: " . mysqli_error($connect));
        die("Error finding user");
    }

    $feedbackc = mysqli_fetch_assoc($sql);
    
    if (!$feedbackc) {
        error_log("No user found with ID: $feedback_sender");
        die("User not found");
    }

    // Insert feedback
    $sql2 = mysqli_query($connect, "INSERT INTO feedbackmessage (userid, fname, lname, img, feedback, rating) 
            VALUES (
                '{$feedbackc['userid']}',
                '{$feedbackc['fname']}',
                '{$feedbackc['lname']}',
                '{$feedbackc['img']}',
                '$feedback_message',
                $rating
            )");

    if ($sql2) {
        echo 'run';
    } else {
        error_log("Insert error: " . mysqli_error($connect));
        echo "Database error: " . mysqli_error($connect);
    }
} else {
    error_log("Validation failed - Empty fields detected");
    echo "Please fill all required fields";
}
?>