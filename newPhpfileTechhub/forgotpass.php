<?php
session_start();
include_once "../database.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

header('Content-Type: application/json');

if(isset($_POST['email'])) {
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    
    // Check if email exists
    $sql = "SELECT * FROM account WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password']; // Get the password
        
        // Create PHPMailer instance
        $mail = new PHPMailer(true);
        
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'iquenxzx@gmail.com'; // Replace with your email
            $mail->Password = 'lews hdga hdvb glym'; // Replace with your app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            
            // Recipients
            $mail->setFrom('iquenxzx@gmail.com', 'Tech Hub');
            $mail->addAddress($email);
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Password Recovery - Tech Hub';
            $mail->Body = '
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Password Recovery - TechHub</title>
                </head>
                <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
                        <tr>
                            <td style="padding: 40px 30px; background-color: #0A1628;">
                                <!-- Header -->
                                <div style="text-align: center; margin-bottom: 30px;">
                                    <h1 style="color: #60A5FA; margin: 0; font-size: 28px;">Password Recovery 🔐</h1>
                                </div>

                                <!-- Message -->
                                <div style="color: #E2E8F0; margin-bottom: 30px; font-size: 16px; text-align: center;">
                                    We received your request for your account password. Here are your login credentials.
                                </div>

                                <!-- Credentials Box -->
                                <div style="background-color: #1E293B; padding: 25px; border-left: 4px solid #60A5FA; margin: 25px 0; border-radius: 0 8px 8px 0;">
                                    <div style="color: #FFFFFF; font-weight: bold; margin-bottom: 15px;">
                                        Your Account Details:
                                    </div>
                                    <ul style="list-style: none; padding: 0; margin: 0; color: #E2E8F0;">
                                        <li style="margin: 10px 0; padding-left: 20px;">→ Email: '.$email.'</li>
                                        <li style="margin: 10px 0; padding-left: 20px;">→ Password: '.$password.'</li>
                                    </ul>
                                </div>

                                <!-- Security Notice -->
                                <div style="background-color: #1E293B; padding: 25px; margin: 25px 0; border-radius: 8px;">
                                    <div style="color: #60A5FA; font-weight: bold; margin-bottom: 15px; font-size: 18px;">
                                        Security Recommendations 🛡️
                                    </div>
                                    <ul style="list-style: none; padding: 0; margin: 0; color: #E2E8F0;">
                                        <li style="margin: 10px 0; padding-left: 20px;">→ Change your password after logging in</li>
                                        <li style="margin: 10px 0; padding-left: 20px;">→ Use a strong, unique password</li>
                                        <li style="margin: 10px 0; padding-left: 20px;">→ Never share your credentials</li>
                                        <li style="margin: 10px 0; padding-left: 20px;">→ Enable two-factor authentication if available</li>
                                    </ul>
                                </div>

                                <!-- Footer -->
                                <div style="text-align: center; margin-top: 30px; padding-top: 30px; border-top: 1px solid #2D3748; color: #E2E8F0;">
                                    <p style="margin: 10px 0;">If you did not request this password recovery, please contact us immediately.</p>
                                    <p style="margin: 10px 0; color: #60A5FA; font-family: monospace; font-size: 18px;">&lt; Stay Secure! /&gt;</p>
                                    <p style="margin: 10px 0;">Best regards,<br>The TechHub Team</p>
                                    
                                    <!-- Social Links -->
                                    <div style="margin: 20px 0;">
                                        <a href="https://www.facebook.com/iquen.marba.7/l" style="color: #60A5FA; text-decoration: none; margin: 0 10px; background-color: #1E293B; padding: 8px 16px; border-radius: 4px;">Facebook</a>
                                        <a href="https://github.com/kenox28" style="color: #60A5FA; text-decoration: none; margin: 0 10px; background-color: #1E293B; padding: 8px 16px; border-radius: 4px;">Github</a>
                                        <a href="https://www.instagram.com/k3nek3/" style="color: #60A5FA; text-decoration: none; margin: 0 10px; background-color: #1E293B; padding: 8px 16px; border-radius: 4px;">Instagram</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </body>
                </html>';
            
            $mail->send();
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Your password has been sent to your email'
            ]);
            
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => "Failed to send email. Error: {$mail->ErrorInfo}"
            ]);
        }
        
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Email not found in our records'
        ]);
    }
    
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Email is required'
    ]);
}
?>