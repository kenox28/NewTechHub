<?php
session_start();
include_once "../database.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// Debug logging
error_log("Request Method: " . $_SERVER['REQUEST_METHOD']);
error_log("Content Type: " . $_SERVER['CONTENT_TYPE']);
error_log("POST Data: " . print_r($_POST, true));
error_log("FILES Data: " . print_r($_FILES, true));

// Check if we're getting a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Only POST requests are allowed'
    ]);
    exit;
}

// Check for action parameter
if (empty($_POST['action'])) {
    error_log("Action parameter missing. Available POST data: " . print_r($_POST, true));
    echo json_encode([
        'status' => 'error',
        'message' => 'Action parameter is required'
    ]);
    exit;
}

// Check for email parameter
if (empty($_POST['email'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Email parameter is required'
    ]);
    exit;
}

$action = $_POST['action'];
$email = mysqli_real_escape_string($connect, $_POST['email']);

error_log("Processing action: " . $action . " for email: " . $email);

function generateVerificationCode() {
    return sprintf("%06d", mt_rand(0, 999999));
}

switch ($action) {
    case 'send_code':
        error_log("Executing send_code case");
        $sql = "SELECT * FROM account WHERE email = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if(mysqli_num_rows($result) > 0) {
            $verificationCode = generateVerificationCode();
            
            // Store verification code in session
            $_SESSION['reset_code'] = $verificationCode;
            $_SESSION['reset_email'] = $email;
            $_SESSION['reset_time'] = time();
            
            error_log("Generated verification code: " . $verificationCode);
            
            $mail = new PHPMailer(true);
            
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'iquenxzx@gmail.com';
                $mail->Password = 'lews hdga hdvb glym';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;
                
                $mail->setFrom('iquenxzx@gmail.com', 'Tech Hub');
                $mail->addAddress($email);
                
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Verification Code - Tech Hub';
                $mail->Body = "
                    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;'>
                        <h2 style='color: #0A1628;'>Password Reset Verification</h2>
                        <p>Your verification code is: <strong style='font-size: 24px; color: #60A5FA;'>$verificationCode</strong></p>
                        <p>This code will expire in 15 minutes.</p>
                        <p>If you didn't request this code, please ignore this email.</p>
                    </div>";
                
                $mail->send();
                error_log("Email sent successfully");
                
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Verification code sent to your email'
                ]);
            } catch (Exception $e) {
                error_log("Email sending failed: " . $mail->ErrorInfo);
                echo json_encode([
                    'status' => 'error',
                    'message' => "Failed to send verification code. Error: {$mail->ErrorInfo}"
                ]);
            }
        } else {
            error_log("Email not found in database: " . $email);
            echo json_encode([
                'status' => 'error',
                'message' => 'Email not found in our records'
            ]);
        }
        break;

    case 'verify_code':
        error_log("Executing verify_code case");
        if (!isset($_POST['verification_code'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Verification code is required'
            ]);
            exit;
        }
        
        $submittedCode = $_POST['verification_code'];
        
        if (!isset($_SESSION['reset_code']) || !isset($_SESSION['reset_time']) || 
            $_SESSION['reset_email'] !== $email) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid or expired session'
            ]);
            exit;
        }
        
        // Check if code is expired (15 minutes)
        if (time() - $_SESSION['reset_time'] > 900) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Verification code has expired'
            ]);
            exit;
        }
        
        if ($submittedCode === $_SESSION['reset_code']) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Code verified successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid verification code'
            ]);
        }
        break;

    case 'reset_password':
        error_log("Executing reset_password case");
        if (!isset($_POST['verification_code']) || !isset($_POST['new_password'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing required parameters'
            ]);
            exit;
        }
        
        if (!isset($_SESSION['reset_code']) || !isset($_SESSION['reset_time']) || 
            $_SESSION['reset_email'] !== $email) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid or expired session'
            ]);
            exit;
        }
        
        $verificationCode = $_POST['verification_code'];
        $newPassword = $_POST['new_password'];
        
        if ($verificationCode !== $_SESSION['reset_code']) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid verification code'
            ]);
            exit;
        }
        
        // Update password in database
        $sql = "UPDATE account SET password = ? WHERE email = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $newPassword, $email);
        
        if (mysqli_stmt_execute($stmt)) {
            // Clear reset session data
            unset($_SESSION['reset_code']);
            unset($_SESSION['reset_email']);
            unset($_SESSION['reset_time']);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Password reset successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to update password'
            ]);
        }
        break;

    default:
        error_log("Invalid action received: " . $action);
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid action'
        ]);
}
?>