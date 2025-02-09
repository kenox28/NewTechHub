<?php
include "../database.php"; // Include your database connection

if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($connect, $_GET['email']);
    $sql = "SELECT * FROM account WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("Account not found.");
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
    <link rel="stylesheet" href="../css_techbook/update.css?v=1.0.4" />
</head>
<body>
    <h1>Update Account</h1>
    <form action="update_process.php" method="POST">
        <input type="hidden" name="original_email" value="<?php echo htmlspecialchars($row['email']); ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required><br>
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo htmlspecialchars($row['password']); ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>