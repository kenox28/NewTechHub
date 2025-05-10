<?php
include_once "../../database.php";

$input = json_decode(file_get_contents("php://input"), true);

if (isset($input['userid'])) {
    $userid = mysqli_real_escape_string($connect, $input['student_id']);
    $sql = "DELETE FROM account WHERE student_id = '$userid'";

    if (mysqli_query($connect, $sql)) {
        echo json_encode([
            "status" => "success",
            "message" => "User deleted successfully"
        ]);
        
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to delete user"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "No user ID provided"
        ]);
}
?>
