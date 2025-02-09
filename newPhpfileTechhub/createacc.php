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
$fname = mysqli_real_escape_string($connect, $_POST['firstname']);
$lname = mysqli_real_escape_string($connect, $_POST['lastname']);
$email = mysqli_real_escape_string($connect, $_POST['email']);
$password = mysqli_real_escape_string($connect, $_POST['password']);
$gender = mysqli_real_escape_string($connect, $_POST['gender']);
$dateb = mysqli_real_escape_string($connect, $_POST['bday']);

// Check if all required fields are filled
if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password) && !empty($gender) && !empty($dateb)) {
    // Set default image
    $img = 'noprofile.jpg';
    $userid = rand(time(), 1000);
    
    // Handle image upload if present
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $img = $_FILES['img']['name'];
        $tempimage = $_FILES['img']['tmp_name'];
        $folder = '../profileimage/' . $img;
        move_uploaded_file($tempimage, $folder);
    }

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
    $sql1 = "INSERT INTO account (userid, fname, lname, email, password, img, gender, bdate) 
            VALUES ('$userid', '$fname', '$lname', '$email', '$password', '$img', '$gender', '$dateb')";
    
    $result = mysqli_query($connect, $sql1);

    if ($result) {
        // Insert ranking
        $beginner = "INTERN";
        $ranking = "INSERT INTO ranking(rank_id,fname,lname,ranks)
            VALUES('$userid','$fname','$lname','$beginner')";
        $resultR = mysqli_query($connect, $ranking);

        // Insert user info
        $userinfo = "INSERT INTO userinfo(userid,fname,lname)
                    VALUES('$userid','$fname','$lname')";
        $userRESULT = mysqli_query($connect, $userinfo);
        
        // Check if additional inserts were successful
        if (!$resultR || !$userRESULT) {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Secondary database insertions failed: ' . mysqli_error($connect)
            ));
            exit();
        }

        $_SESSION['userid'] = $userid;

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
            $mail->addAddress($email, $fname . ' ' . $lname);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Welcome to TechHub!';
            $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Welcome to TechHub</title>
            </head>
            <body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
                    <tr>
                        <td style="padding: 40px 30px; background-color: #0A1628;">
                            <!-- Header -->
                            <div style="text-align: center; margin-bottom: 30px;">
                                <h1 style="color: #60A5FA; margin: 0; font-size: 28px;">Welcome to TechHub, '.$fname.'! 🚀</h1>
                            </div>
            
                            <!-- Welcome Message -->
                            <div style="color: #E2E8F0; margin-bottom: 30px; font-size: 16px; text-align: center;">
                                Get ready to embark on an exciting journey in tech! We\'re excited to have you join our innovative community.
                            </div>
            
                            <!-- Features Box -->
                            <div style="background-color: #1E293B; padding: 25px; border-left: 4px solid #60A5FA; margin: 25px 0; border-radius: 0 8px 8px 0;">
                                <div style="color: #FFFFFF; font-weight: bold; margin-bottom: 15px;">
                                    Your TechHub Adventure Includes:
                                </div>
                                <ul style="list-style: none; padding: 0; margin: 0; color: #E2E8F0;">
                                    <li style="margin: 10px 0; padding-left: 20px;">→ Access to a thriving developer community</li>
                                    <li style="margin: 10px 0; padding-left: 20px;">→ Cutting-edge tech resources & tutorials</li>
                                    <li style="margin: 10px 0; padding-left: 20px;">→ Real-time tech discussions & updates</li>
                                    <li style="margin: 10px 0; padding-left: 20px;">→ Project showcase opportunities</li>
                                    <li style="margin: 10px 0; padding-left: 20px;">→ Professional networking platform</li>
                                </ul>
                            </div>
            
                            <!-- Next Steps -->
                            <div style="background-color: #1E293B; padding: 25px; margin: 25px 0; border-radius: 8px;">
                                <div style="color: #60A5FA; font-weight: bold; margin-bottom: 15px; font-size: 18px;">
                                    Quick Start Guide 🎯
                                </div>
                                <ul style="list-style: none; padding: 0; margin: 0; color: #E2E8F0;">
                                    <li style="margin: 10px 0; padding-left: 20px;">→ Set up your developer profile</li>
                                    <li style="margin: 10px 0; padding-left: 20px;">→ Join trending tech discussions</li>
                                    <li style="margin: 10px 0; padding-left: 20px;">→ Connect with fellow developers</li>
                                    <li style="margin: 10px 0; padding-left: 20px;">→ Share your tech journey</li>
                                </ul>
                            </div>
            
                            <!-- Footer -->
                            <div style="text-align: center; margin-top: 30px; padding-top: 30px; border-top: 1px solid #2D3748; color: #E2E8F0;">
                                <p style="margin: 10px 0;">Your tech journey starts now!</p>
                                <p style="margin: 10px 0; color: #60A5FA; font-family: monospace; font-size: 18px;">&lt; Happy Coding! /&gt;</p>
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
            
            // Return success response
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Account created successfully!',
                'userData' => array(
                    'name' => $fname . ' ' . $lname,
                    'email' => $email
                )
            ));
            exit();
            
            // In the catch block for email error
            } catch (Exception $e) {
                error_log("Email sending failed: " . $mail->ErrorInfo);
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Account created successfully!',
                    'userData' => array(
                        'name' => $fname . ' ' . $lname,
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