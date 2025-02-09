<?php

include_once "../database.php";
$useridchat = mysqli_real_escape_string($connect, $_GET['userid']);
if ($useridchat) {
    $sql4 = mysqli_query($connect, "SELECT * FROM ranking WHERE rank_id = '{$useridchat}'");
// row3 in this php is to only  show the specific usercidchat column in sql4

    $rankuserc = mysqli_fetch_assoc($sql4);
}
