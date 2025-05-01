<?php
include_once "../../database.php";

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
