<?php
session_start();
include "../database.php";
$status = "Offline";
$sql3 = "UPDATE account SET  status='$status' WHERE userid='{$_SESSION['userid']}'";
$result2 = mysqli_query($connect, $sql3);

if ($result2) {
// Destroy the session
    session_destroy();
    header("location:../newDesignTechbook/login.php");

    exit();

}
