<?php
session_start();
// if wala naka login para no error mo balik sa loginpage
if (!isset($_SESSION['userid'])) {
    header("location:../newDesignTechbook/loginpage.php");
    exit();

}
;

include "../database.php";
$sender = mysqli_real_escape_string($connect, $_POST['sender']);
$receiver = mysqli_real_escape_string($connect, $_POST['reciever']);
$message = mysqli_real_escape_string($connect, $_POST['message']);

if (!empty($message)) {
    $sqlmessage = mysqli_query($connect, "INSERT INTO tb_message(sender_Id,receiver_id,messages)VALUES('$sender','$receiver','$message')");
}
;
