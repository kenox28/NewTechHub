<?php
session_start();
include_once "../database.php";

$response = array();

// Check if form is submitted
if (isset($_POST['cappost']) && isset($_FILES['imgpost'])) {
    $cappost = mysqli_real_escape_string($connect, $_POST['cappost']);
    $imgpost = $_FILES['imgpost']['name'];
    $tempimage = $_FILES['imgpost']['tmp_name'];
    $folder = '../profileimage/' . $imgpost;

    if (move_uploaded_file($tempimage, $folder)) {
        if (!empty($cappost) || !empty($imgpost)) {
            $sql = mysqli_query($connect, "SELECT * FROM account WHERE userid = '{$_SESSION['userid']}'");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
                $sql2 = mysqli_query($connect, "INSERT INTO newsfeed (userid, fname, lname, img1, cappost, imgpost) VALUES ('{$row['userid']}', '{$row['fname']}', '{$row['lname']}', '{$row['img']}', '$cappost', '$imgpost')");

                if ($sql2) {
                    $response['status'] = 'success';
                    $response['message'] = 'Post successfully created!';
                } else {
                    $response['status'] = 'failed';
                    $response['message'] = 'Database error occurred.';
                }
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'User not found.';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Please enter a caption or upload an image.';
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = 'Failed to upload image.';
    }
} else {
    $response['status'] = 'failed';
    $response['message'] = 'Invalid form submission.';
}

echo json_encode($response);
?>
