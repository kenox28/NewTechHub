<?php
include "../../database.php";

$Post = mysqli_query($connect, "SELECT * FROM newsfeed ORDER BY Postdate DESC");

$fetchpost = [];

while ($Fpost = mysqli_fetch_assoc($Post)) {
    $fetchpost[] = $Fpost;
}

header('Content-Type: application/json');
echo json_encode($fetchpost);


?>