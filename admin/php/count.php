<?php
include_once "../../database.php";

$sql = mysqli_query($connect, "
  SELECT 
    SUM(ranks = 'beginner') AS beginners,
    SUM(ranks = 'Intermediate') AS Intermediate,
    SUM(ranks = 'Advanced') AS Advanced,
    SUM(ranks = 'expert') AS expert
  FROM ranking
");

$result = mysqli_fetch_assoc($sql);

header('Content-Type: application/json');
echo json_encode($result);
?>
