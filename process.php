<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"]["tmp_name"];

    if (!file_exists($file)) {
        die("Error: File not uploaded.");
    }

    $action = $_POST["action"];

    if ($action == "hash") {
        echo "<h3>Original Hash:</h3><p>" . hash_file("sha256", $file) . "</p>";
    } elseif ($action == "verify" && isset($_POST["input_hash"])) {
        $new_hash = hash_file("sha256", $file);
        echo "<h3>New Hash:</h3><p>$new_hash</p>";
        echo $new_hash === $_POST["input_hash"] 
            ? "<p style='color: green;'>File integrity verified!</p>" 
            : "<p style='color: red;'>File has been tampered with.</p>";
    }

    echo "<br><a href='index.php'>Go Back</a>";
} else {
    echo "Error: Invalid request.";
}
?>
