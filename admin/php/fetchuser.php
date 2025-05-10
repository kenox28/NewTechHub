<?php
include_once "../../database.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: http://soctech.wuaze.com');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');
$sql3 = mysqli_query($connect, "SELECT * FROM account");

$users = [];

while ($userC = mysqli_fetch_assoc($sql3)) {
    $users[] = $userC;
}

header('Content-Type: application/json');
echo json_encode($users);


?>
