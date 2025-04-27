<?php
include_once "../../database.php";

$sql3 = mysqli_query($connect, "SELECT * FROM account");

$users = [];

while ($userC = mysqli_fetch_assoc($sql3)) {
    $users[] = $userC;
}

header('Content-Type: application/json');
echo json_encode($users);


?>
