<?php
include "../../database.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: http://soctech.wuaze.com');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');
$Post = mysqli_query($connect, "SELECT * FROM newsfeed WHERE react > 2000 ORDER BY react DESC");

$fetchpost = [];

while ($Fpost = mysqli_fetch_assoc($Post)) {
    if ($Fpost['react'] > 4000) {
        $updateRank = mysqli_query($connect, "UPDATE ranking SET ranks = 'SENIOR DEV' WHERE rank_id = '{$Fpost['userid']}'");
    } elseif ($Fpost['react'] > 3000) {
        $updateRank = mysqli_query($connect, "UPDATE ranking SET ranks = 'MID-LEVEL' WHERE rank_id = '{$Fpost['userid']}'");
    } elseif ($Fpost['react'] > 2000) {
        $updateRank = mysqli_query($connect, "UPDATE ranking SET ranks = 'JUNIOR DEV' WHERE rank_id = '{$Fpost['userid']}'");
    }
    $fetchpost[] = $Fpost;
}

header('Content-Type: application/json');
echo json_encode($fetchpost);


?>