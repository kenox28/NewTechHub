<?php
session_start();
include_once "../database.php";

$email = mysqli_real_escape_string($connect, $_POST['email']);
$pass = mysqli_real_escape_string($connect, $_POST['password']);

$output = '';

if (!empty($email) && !empty($pass)) {
    $sql = "SELECT * FROM account WHERE email ='{$email}' AND password ='{$pass}'";
    $sql2 = "SELECT * FROM tb_admin WHERE email ='{$email}' AND password ='{$pass}'";
    $result = mysqli_query($connect, $sql);
    $result2 = mysqli_query($connect, $sql2);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the row as an associative array
        $row = mysqli_fetch_assoc($result);

        $_SESSION['userid'] = $row['userid'];
        echo "success";
        exit();
    } elseif ($result2 && mysqli_num_rows($result2) > 0) {
        echo "admin";
    } else {
        echo "Invalid email or password.";
    }
}
echo $output;
