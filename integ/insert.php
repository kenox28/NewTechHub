<?php
ini_set("log_errors", 1);
ini_set("error_log", "php-error.log");
error_reporting(E_ALL);

// DB connection
$host = "localhost";
$dbname = "evsu";
$username = "root";
$password = "";

header("Access-Control-Allow-Origin: *");
header("X-Content-Type-Options: nosniff");
header("Content-Type: application/json; charset=utf-8");

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';
    $fname = $_POST["fname"] ?? '';
    $plain_password = $_POST["password"] ?? '';
    $profile_img = $_POST["profile_img"] ?? 'default.png';

    if ($email && $fname && $plain_password) {
        $name = $fname;
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

        try {
            // Check if user exists
            $checkStmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $checkStmt->execute([$email]);

            if ($checkStmt->rowCount() > 0) {
                echo json_encode(["status" => "error", "message" => "User already exists"]);
                exit;
            }

            // Insert new user
            $stmt = $pdo->prepare("INSERT INTO users (name, profile_img, email, password) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $profile_img, $email, $hashed_password]);

            echo json_encode(["status" => "success", "message" => "User inserted successfully"]);
        } catch (PDOException $e) {
            error_log("Insert failed: " . $e->getMessage());
            echo json_encode(["status" => "error", "message" => "Insert failed"]);
        }
        exit;
    } else {
        echo json_encode(["status" => "error", "message" => "Missing required fields"]);
        exit;
    }
}

echo json_encode(["status" => "error", "message" => "Invalid request method"]);
?>
