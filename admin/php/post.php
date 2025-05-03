<?php
include "../../database.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: http://soctech.wuaze.com');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');
$Post = mysqli_query($connect, "SELECT * FROM newsfeed ORDER BY Postdate DESC");

$fetchpost = [];

while ($Fpost = mysqli_fetch_assoc($Post)) {
    $fetchpost[] = $Fpost;
}

header('Content-Type: application/json');
echo json_encode($fetchpost);


?>