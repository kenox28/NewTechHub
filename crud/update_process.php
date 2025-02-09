<?php
include "../database.php"; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $original_email = mysqli_real_escape_string($connect, $_POST['original_email']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    $sql = "UPDATE account SET email = '$email', username = '$username', password = '$password' WHERE email = '$original_email'";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        header("Location: view.php"); // Redirect back to the view page
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($connect);
    }
} else {
    echo "Invalid request method.";
}
?>