<?php
include "../database.php"; // Include your database connection

// Fetch all records from the account table
$sql = "SELECT * FROM account";
$result = mysqli_query($connect, $sql);

if (!$result) {
    die("Query Failed: " . mysqli_error($connect));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Accounts</title>
    <link rel="stylesheet" href="create1.css?v=1.0.4" />

</head>
<body>
    <h1>Account List</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Email</th>
                <th>Username</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['password']); ?></td>
                    <td>
                        <form action="delete.php" method="POST" style="display:inline;">
                            <input type="hidden" name="email" value="<?php echo htmlspecialchars($row['email']); ?>">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this account?');">Delete</button>
                        </form>
                        <form action="update.php" method="GET" style="display:inline;">
                            <input type="hidden" name="email" value="<?php echo htmlspecialchars($row['email']); ?>">
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>