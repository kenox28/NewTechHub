<?php
include_once "../database.php";

// Fetch posts with LIMIT and OFFSET
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
// $sql4 = mysqli_query($connect, "SELECT * FROM newsfeed WHERE react > 2000 ORDER BY react DESC, postdate DESC");
$sql = "SELECT * FROM newsfeed WHERE react > 2000 ORDER BY react DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($connect, $sql);

$posts = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Update ranks based on reactions
        if ($row['react'] > 4000) {
            $updateRank = mysqli_query($connect, "UPDATE ranking SET ranks = 'SENIOR DEV' WHERE rank_id = '{$row['userid']}'");
        } elseif ($row['react'] > 3000) {
            $updateRank = mysqli_query($connect, "UPDATE ranking SET ranks = 'MID-LEVEL' WHERE rank_id = '{$row['userid']}'");
        } elseif ($row['react'] > 2000) {
            $updateRank = mysqli_query($connect, "UPDATE ranking SET ranks = 'JUNIOR DEV' WHERE rank_id = '{$row['userid']}'");
        }

        $posts[] = [
            'id' => (int)$row['id'],
            'fname' => htmlspecialchars($row['fname']),
            'lname' => htmlspecialchars($row['lname']),
            'img1' => htmlspecialchars($row['img1']),
            'imgpost' => htmlspecialchars($row['imgpost']),
            'cappost' => htmlspecialchars($row['cappost']),
            'react' => (int)$row['react'],
            'upvoted' => isset($_SESSION['up_' . $row['id']]) ? true : false,
            'downvoted' => isset($_SESSION['down_' . $row['id']]) ? true : false,
        ];
    }
}

echo json_encode(["status" => "success", "message"=>"succcefuly fetch top post", $posts]);
?>
