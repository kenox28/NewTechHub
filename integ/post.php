<?php
session_start();
$host = "localhost";
$dbname = "progbook";
$username = "root";
$password = "";
// $key = "secret";

header("Access-Control-Allow-Origin: *");
header("X-Content-Type-Options: nosniff");
header("Content-Type: application/json; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");

// If it's a preflight request (OPTION), return the allowed headers
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    exit(0);
}

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "tanginamo";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"]) && $_POST["action"] === "GET_users") {
        $get_user = "SELECT * FROM account";

        $stmt = $pdo->prepare($get_user);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$result) {
            echo json_encode([
                "status" => "error",
                "message" => "no user found."
            ]);
            exit;
        }

        echo json_encode([
            "status" => "success",
            "message" => "user(s) found.",
            "users" => $result,
            "directory" => "/profileimage/"
        ]);
        exit;
    } 

    if (isset($_POST["action"]) && $_POST["action"] === "current_user") {
        $get_user = "SELECT * FROM account WHERE userid = {$_SESSION['userid']}";

        $stmt = $pdo->prepare($get_user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            echo json_encode([
                "status" => "error",
                "message" => "no user found."
            ]);
            exit;
        }
        $response = [
            "status" => "success",
            "message" => "user(s) found.",
            "user" => $result,
            "directory" => "/profileimage/"
        ];
        echo json_encode($response);
        exit;
    }
    
    // else {
    //     echo json_encode([
    //         "status" => "error",
    //         "message" => "Invalid action."
    //     ]);
    //     exit;
    // }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method. Use POST."
    ]);
}
?>