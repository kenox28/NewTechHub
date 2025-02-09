<?php
$status = "Active now";

include_once "../database.php";
$sql = mysqli_query($connect, "SELECT * FROM account WHERE userid = '{$_SESSION['userid']}'");
$sql3 = "UPDATE account SET  status='$status' WHERE userid='{$_SESSION['userid']}'";
$result2 = mysqli_query($connect, $sql3);

if (mysqli_num_rows($sql) > 0) {
    $userCname = mysqli_fetch_assoc($sql);
}

// $sql2 = "INSERT INTO history (fname,lname,img,status) VALUES ('{$userCname['fname']}', '{$userCname['lname']}', '{$userCname['img']}','$status')";
// $result = mysqli_query($connect, $sql2);
