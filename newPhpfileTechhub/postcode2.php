<?php
session_start();
include_once "../database.php";
require '../vendor/autoload.php';

use FFMpeg\FFProbe;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$response = array();

// Check if form is submitted
if (isset($_POST['cappost']) && isset($_FILES['imgpost'])) {
    $cappost = mysqli_real_escape_string($connect, $_POST['cappost']);
    $mediaFile = $_FILES['imgpost'];
    $tempFile = $mediaFile['tmp_name'];
    $fileName = $mediaFile['name'];
    $fileType = $mediaFile['type'];

    // Fetch user data
    $sql = mysqli_query($connect, "SELECT * FROM account WHERE userid = '{$_SESSION['userid']}'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);

        // Check for upload errors
        if ($mediaFile['error'] !== UPLOAD_ERR_OK) {
            $response['status'] = 'failed';
            $response['message'] = 'File upload error: ' . $mediaFile['error'];
            echo json_encode($response);
            exit;
        }

        // Determine if the file is an image or video
        if (strpos($fileType, 'image/') === 0) {
            // Handle image upload
            $folder = '../profileimage/' . $fileName;

            // Check if the profileimage directory exists and is writable
            if (!is_dir('../profileimage')) {
                mkdir('../profileimage', 0755, true); // Create directory if it doesn't exist
            }

            if (move_uploaded_file($tempFile, $folder)) {
                // Store image path in the database
                $sql2 = mysqli_query($connect, "INSERT INTO newsfeed (userid, fname, lname, img1, cappost, imgpost) VALUES ('{$row['userid']}', '{$row['fname']}', '{$row['lname']}', '{$row['img']}', '$cappost', '$fileName')");
                if ($sql2) {
                    $response['status'] = 'success';
                    $response['message'] = 'Post successfully created!';
                } else {
                    $response['status'] = 'failed';
                    $response['message'] = 'Database error: ' . mysqli_error($connect);
                }
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'Failed to upload image.';
            }
        } elseif (strpos($fileType, 'video/') === 0) {
            // Handle video upload
            $videoFolder = '../SRCVIDEO/' . $fileName;

            // Check if the SRCVIDEO directory exists and is writable
            if (!is_dir('../SRCVIDEO')) {
                mkdir('../SRCVIDEO', 0755, true); // Create directory if it doesn't exist
            }

            // Check video duration using FFMpeg
            $ffprobe = FFProbe::create([
                'ffmpeg.binaries'  => 'C:/xampp/htdocs/Techhub2sirmorps/ffmpeg-7.1.1-essentials_build/bin/ffmpeg.exe',  // Adjust this path
                'ffprobe.binaries' => 'C:/xampp/htdocs/Techhub2sirmorps/ffmpeg-7.1.1-essentials_build/bin/ffprobe.exe'   // Adjust this path
            ]);
            $duration = $ffprobe->format($tempFile)->get('duration');

            // Check if the duration is less than or equal to 30 seconds
            if ($duration <= 30) {
                if (move_uploaded_file($tempFile, $videoFolder)) {
                    // Store video path in the database
                    $sql2 = mysqli_query($connect, "INSERT INTO newsfeed (userid, fname, lname, img1, cappost, videopost) VALUES ('{$row['userid']}', '{$row['fname']}', '{$row['lname']}', '{$row['img']}', '$cappost', '$fileName')");
                    if ($sql2) {
                        $response['status'] = 'success';
                        $response['message'] = 'Post successfully created!';
                    } else {
                        $response['status'] = 'failed';
                        $response['message'] = 'Database error: ' . mysqli_error($connect);
                    }
                } else {
                    $response['status'] = 'failed';
                    $response['message'] = 'Failed to upload video. Error: ' . error_get_last()['message'];
                }
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'Video duration exceeds 30 seconds.';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Invalid file type.';
        }
    } else {
        $response['status'] = 'failed';
        $response['message'] = 'User not found.';
    }
} else {
    $response['status'] = 'failed';
    $response['message'] = 'Invalid form submission.';
}

echo json_encode($response);
?>