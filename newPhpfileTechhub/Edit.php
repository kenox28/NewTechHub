<?php
session_start();
include_once "../database.php";

// Check if user is logged in
if (!isset($_SESSION['userid'])) {
    die("User not logged in.");
}

// Sanitize and retrieve form data
$nfname = mysqli_real_escape_string($connect, $_POST['firstname']);
$nlname = mysqli_real_escape_string($connect, $_POST['lastname']);
$npassword = mysqli_real_escape_string($connect, $_POST['password']);
$number = mysqli_real_escape_string($connect, $_POST['number']);
$address = mysqli_real_escape_string($connect, $_POST['address']);
$course = mysqli_real_escape_string($connect, $_POST['course']);
$pl = mysqli_real_escape_string($connect, $_POST['pl']);
$secyr = mysqli_real_escape_string($connect, $_POST['secyr']);

// Handle profile image upload
$nimg = null;
if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
    $nimg = $_FILES['img']['name'];
    $tempimage = $_FILES['img']['tmp_name'];
    $folder = '../profileimage/' . $nimg;
    if (!move_uploaded_file($tempimage, $folder)) {
        die("Failed to upload image.");
    }
}

// Update queries
$sql1 = "UPDATE account SET fname='$nfname', lname='$nlname', number='$number'";
if ($nimg) {
    $sql1 .= ", img='$nimg'";
}
$sql1 .= " WHERE userid='{$_SESSION['userid']}'";

$sql2 = "UPDATE userinfo SET fname='$nfname', lname='$nlname', address='$address', course='$course', pl='$pl', sectionyr='$secyr' WHERE userid='{$_SESSION['userid']}'";

$sql3 = "UPDATE newsfeed SET fname='$nfname', lname='$nlname'";
if ($nimg) {
    $sql3 .= ", img1='$nimg'";
}
$sql3 .= " WHERE userid='{$_SESSION['userid']}'";

$sql4 = "UPDATE ranking SET fname='$nfname', lname='$nlname' WHERE rank_id='{$_SESSION['userid']}'";

// Execute queries
$result = mysqli_query($connect, $sql1);
if (!$result) {
    die("Error in SQL1: " . mysqli_error($connect));
}

$result2 = mysqli_query($connect, $sql2);
if (!$result2) {
    die("Error in SQL2: " . mysqli_error($connect));
}

$result3 = mysqli_query($connect, $sql3);
if (!$result3) {
    die("Error in SQL3: " . mysqli_error($connect));
}

$result4 = mysqli_query($connect, $sql4);
if (!$result4) {
    die("Error in SQL4: " . mysqli_error($connect));
}

if ($result) {
    echo json_encode([
        "status" => "success",
        "userid" => $_SESSION['userid']
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to update profile."
    ]);
}   
