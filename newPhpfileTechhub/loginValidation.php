<?php
session_start();
include_once "../database.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

header('Content-Type: application/json');

if (!isset($_POST['action'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Action is required'
    ]);
    exit;
}

$action = $_POST['action'];
$email = mysqli_real_escape_string($connect, $_POST['email']);
$password = mysqli_real_escape_string($connect, $_POST['password']);

function generateOTP() {
    return sprintf("%06d", mt_rand(0, 999999));
}

function sendOTPEmail($email, $otp) {
    $mail = new PHPMailer(true);
    try {
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
        $mail->Subject = 'Login OTP Verification - Tech Hub';
        $mail->Body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;'>
                <h2 style='color: #0A1628;'>Login Verification</h2>
                <p>Your OTP code is: <strong style='font-size: 24px; color: #60A5FA;'>$otp</strong></p>
                <p>This code will expire in 15 minutes.</p>
                <p>If you didn't request this code, please ignore this email.</p>
            </div>";
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Failed to send OTP email: " . $mail->ErrorInfo);
        return false;
    }
}

switch ($action) {
    case 'verify_credentials':
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
            // Generate and store OTP
            $otp = generateOTP();
            $_SESSION['login_otp'] = $otp;
            $_SESSION['login_otp_time'] = time();
            $_SESSION['login_email'] = $email;
            $_SESSION['is_admin'] = mysqli_num_rows($result2) > 0;

            // Send OTP email
            if (sendOTPEmail($email, $otp)) {
                echo json_encode([
                    'status' => 'credentials_valid',
                    'message' => 'OTP sent to your email'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to send OTP'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid email or password'
            ]);
        }
        break;

    case 'verify_otp':
        if (!isset($_POST['otp']) || !isset($_SESSION['login_otp']) || 
            !isset($_SESSION['login_otp_time']) || !isset($_SESSION['login_email'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid session or missing OTP'
            ]);
            exit;
        }

        // Check if OTP is expired (15 minutes)
        if (time() - $_SESSION['login_otp_time'] > 900) {
            echo json_encode([
                'status' => 'error',
                'message' => 'OTP has expired'
            ]);
            exit;
        }

        if ($_POST['otp'] === $_SESSION['login_otp'] && $email === $_SESSION['login_email']) {
            // Get user data
            if ($_SESSION['is_admin']) {
                $sql = "SELECT * FROM tb_admin WHERE email = ?";
            } else {
                $sql = "SELECT * FROM account WHERE email = ?";
            }
            
            $stmt = mysqli_prepare($connect, $sql);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);

            // Set session variables
            if ($_SESSION['is_admin']) {
                $_SESSION['userid'] = $row['adminid'];
            } else {
                $_SESSION['userid'] = $row['userid'];
            }

            // Clear OTP session data
            unset($_SESSION['login_otp']);
            unset($_SESSION['login_otp_time']);
            unset($_SESSION['login_email']);

            echo json_encode([
                'status' => 'success',
                'role' => $_SESSION['is_admin'] ? 'admin' : 'user'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid OTP'
            ]);
        }
        break;

    default:
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid action'
        ]);
}
?>
