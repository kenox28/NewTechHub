<?php
session_start();
include "../database.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get and sanitize form data
$username = mysqli_real_escape_string($connect, $_POST['username']);
$email = mysqli_real_escape_string($connect, $_POST['email']);
$password = mysqli_real_escape_string($connect, $_POST['password']);

// Check if all required fields are filled
if (!empty($username) && !empty($email) && !empty($password)) {

    // Check if email already exists
    $sql2 = mysqli_query($connect, "SELECT * FROM account WHERE email = '{$email}'");
    if (mysqli_num_rows($sql2) > 0) {
        echo json_encode(array(
            'status' => 'failed',
            'message' => 'Email already exists'
        ));
        exit();
    }

    // Insert new account
    $sql1 = "INSERT INTO account (email,username, password) 
            VALUES ('$email','$username','$password')";
    
    $result = mysqli_query($connect, $sql1);

    if ($result) {
        $_SESSION['username'] = $username;

        // Send welcome email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                           // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';      // Set the SMTP server
            $mail->SMTPAuth   = true;                  // Enable SMTP authentication
            $mail->Username   = 'iquenxzx@gmail.com';  // SMTP username
            $mail->Password   = 'lews hdga hdvb glym'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
            $mail->Port       = 465;                   // TCP port to connect to; use 465 for SSL

            // Recipients
            $mail->setFrom('iquenxzx@gmail.com', 'TechHub Team');
            $mail->addAddress($email, $username);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Welcome to TechHub!';
            $mail->Body = '...'; // Email body content

            $mail->send();
            
            // Return success response
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Account created successfully!',
                'userData' => array(
                    'username' => $username,
                    'email' => $email
                )
            ));
            exit();
            
        } catch (Exception $e) {
            error_log("Email sending failed: " . $mail->ErrorInfo);
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Account created successfully!',
                'userData' => array(
                    'username' => $username,
                    'email' => $email
                ),
                'emailError' => "Note: Welcome email could not be sent."
            ));
            exit();
        }
    } else {
        // Main account insertion failed
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Account creation failed: ' . mysqli_error($connect)
        ));
    }
} else {
    // Missing required fields
    echo json_encode(array(
        'status' => 'empty',
        'message' => 'Please fill in all required fields'
    ));
}
?>