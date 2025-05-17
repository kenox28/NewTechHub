<?php
session_start();
include_once "../database.php";
header('Content-Type: application/json');

if (!isset($_POST['action']) || $_POST['action'] !== 'login') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid action'
    ]);
    exit;
}

$email = mysqli_real_escape_string($connect, $_POST['email']);
$password = mysqli_real_escape_string($connect, $_POST['password']);

// Check user credentials
$sql = "SELECT * FROM account WHERE email = ? AND password = ?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "ss", $email, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$sql2 = "SELECT * FROM tb_admin WHERE email = ? AND password = ?";
$stmt2 = mysqli_prepare($connect, $sql2);
mysqli_stmt_bind_param($stmt2, "ss", $email, $password);
mysqli_stmt_execute($stmt2);
$result2 = mysqli_stmt_get_result($stmt2);

if (mysqli_num_rows($result) > 0 || mysqli_num_rows($result2) > 0) {
    if (mysqli_num_rows($result2) > 0) {
        $row = mysqli_fetch_assoc($result2);
        $_SESSION['userid'] = $row['useridaddmin'];
        echo json_encode([
            'status' => 'success',
            'role' => 'admin'
        ]);
    } else {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['userid'] = $row['userid'];
        echo json_encode([
            'status' => 'success',
            'role' => 'user'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid email or password'
    ]);
}
?>
