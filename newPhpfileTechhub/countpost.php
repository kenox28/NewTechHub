<?php
include_once "../database.php";

$sql5 = mysqli_query($connect, "SELECT COUNT(*) AS total FROM newsfeed WHERE userid = '{$selectCname['userid']}' AND react > 1000");
$row5 = mysqli_fetch_assoc($sql5);
$total = $row5['total'];

if ($total > 10) {
    // if user have 10 count of post react or vote nanakaabot og 1000
    $updateRank = mysqli_query($connect, 
        "UPDATE ranking 
        SET Percent = 100 
        WHERE rank_id = '{$selectCname['userid']}'");
} elseif ($total >= 6) {
    // if user have 10 count of post react  ore vote

    $updateRank = mysqli_query($connect, 
        "UPDATE ranking 
        SET Percent = 60 
        WHERE rank_id = '{$selectCname['userid']}'");
} elseif ($total >= 3) {
    // if user have 10 count of post react or vote

    $updateRank = mysqli_query($connect, 
        "UPDATE ranking 
        SET Percent = 30 
        WHERE rank_id = '{$selectCname['userid']}'");
}
?>
                            