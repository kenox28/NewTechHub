<?php
include_once "../../database.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: http://soctech.wuaze.com');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);

// Check if the input contains the 'userid'
if (isset($input['userid'])) {
    $userid = $input['userid']; // Correct key name

    // Ensure the database connection is valid
    if (!$connect) {
        echo json_encode([
            "status" => "error",
            "message" => "Database connection failed: " . mysqli_connect_error()
        ]);
        exit();
    }

    // Prepare the SQL query (use correct column name, e.g., 'userid')
    $stmt = mysqli_prepare($connect, "DELETE FROM account WHERE userid = ?");
    if (!$stmt) {
        echo json_encode([
            "status" => "error",
            "message" => "Preparation failed: " . mysqli_error($connect)
        ]);
        exit();
    }

    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "i", $userid);
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode([
            "status" => "success",
            "message" => "User deleted successfully"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Execution failed: " . mysqli_stmt_error($stmt)
        ]);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "No user ID provided"
    ]);
}
?>
