<?php
include_once "../database.php";

header('Content-Type: application/json');

// Get offset and limit from query parameters
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;

// Fetch posts with LIMIT and OFFSET
$sql = "SELECT * FROM newsfeed ORDER BY postdate DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($connect, $sql);

$posts = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
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

echo json_encode($posts);
?>
