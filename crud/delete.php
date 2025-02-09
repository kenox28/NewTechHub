<?php
include "../database.php"; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($connect, $_POST['email']);

    // Delete the record from the account table
    $sql = "DELETE FROM account WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        header("Location: view.php"); // Redirect back to the view page
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($connect);
    }
} else {
    echo "Invalid request method.";
}
?>