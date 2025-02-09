<?php
include_once "../database.php";
$useridchat = mysqli_real_escape_string($connect, $_GET['userid']);
if ($useridchat) {
    $sql = mysqli_query($connect, "SELECT * FROM userinfo WHERE userid = '{$useridchat}'");
    // Fetch the data BEFORE trying to use it
    $userinfoc = mysqli_fetch_assoc($sql);
}
?>