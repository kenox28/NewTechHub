<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from POST data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password using MD5
    $hashedPassword = md5($password);

    // Display the username and MD5 hashed password
    echo "<h3>Welcome, " . htmlspecialchars($username) . "!</h3>";
    echo "<p>Your MD5 hashed password is: " . htmlspecialchars($hashedPassword) . "</p>";
}
?>
