<?php
session_start();
include_once "../database.php";

$nfname = mysqli_real_escape_string($connect, $_POST['firstname']);
$nlname = mysqli_real_escape_string($connect, $_POST['lastname']);
$nemail = mysqli_real_escape_string($connect, $_POST['email']);
$npassword = mysqli_real_escape_string($connect, $_POST['password']);
$ngender = mysqli_real_escape_string($connect, $_POST['gender']);
$ndateb = mysqli_real_escape_string($connect, $_POST['bday']);
$number = mysqli_real_escape_string($connect, $_POST['number']);

$address = mysqli_real_escape_string($connect, $_POST['address']);
$course = mysqli_real_escape_string($connect, $_POST['course']);
$pl = mysqli_real_escape_string($connect, $_POST['pl']);
$secyr = mysqli_real_escape_string($connect, $_POST['secyr']);

if (isset($_FILES['img'])) {
    $nimg = $_FILES['img']['name'];
    $tempimage = $_FILES['img']['tmp_name'];
    $folder = '../profileimage/' . $nimg;
    move_uploaded_file($tempimage, $folder);
}

$sql1 = "UPDATE account SET fname='$nfname', lname='$nlname', email='$nemail', password='$npassword', img='$nimg', gender='$ngender', bdate='$ndateb', dateadded=NOW(), number='$number' WHERE userid='{$_SESSION['userid']}'";
$sql2 = "UPDATE userinfo SET fname='$nfname', lname='$nlname', address='$address', course='$course',pl='$pl', sectionyr='$secyr' WHERE userid='{$_SESSION['userid']}'";
$sql3 = "UPDATE newsfeed SET fname='$nfname', lname='$nlname', img1='$nimg' WHERE userid='{$_SESSION['userid']}'";
$sql4 = "UPDATE ranking SET fname='$nfname', lname='$nlname' WHERE rank_id='{$_SESSION['userid']}'";

$result = mysqli_query($connect, $sql1);
$result2 = mysqli_query($connect, $sql2);
$result3 = mysqli_query($connect, $sql3);
$result4 = mysqli_query($connect, $sql4);


if ($result && $result2 && $result3 && $result4) {
    // Update successful
    // Redirect or display a success message
} else {
    // Update failed
    // Handle error case
}
