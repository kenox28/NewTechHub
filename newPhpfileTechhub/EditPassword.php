<?php
session_start();
include_once "../database.php";

$npassword = mysqli_real_escape_string($connect, $_POST['password']);

$sql = "UPDATE account SET password='$npassword' WHERE userid='{$_SESSION['userid']}'";

$result = mysqli_query($connect, $sql);

if ($result) {
    echo "Password updated successfully.";
} else {
    echo "Failed to update password.";
}
