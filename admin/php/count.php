<?php
include_once "../../database.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: http://soctech.wuaze.com');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');
$sql = mysqli_query($connect, "
  SELECT 
    SUM(ranks = 'INTERN') AS beginners,
    SUM(ranks = 'JUNIOR DEV') AS Intermediate,
    SUM(ranks = 'MID-LEVEL') AS Advanced,
    SUM(ranks = 'SENIOR DEV') AS expert
  FROM ranking
");

$result = mysqli_fetch_assoc($sql);

header('Content-Type: application/json');
echo json_encode($result);
?>
