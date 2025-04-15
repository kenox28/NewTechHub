<?php
session_start();
include "../database.php";
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if OTP is being verified
if (isset($_POST['OTP'])) {
    if ($_POST['OTP'] == $_SESSION['otp']) {
        // Proceed with account creation
        $fname = mysqli_real_escape_string($connect, $_SESSION['fname']);
        $lname = mysqli_real_escape_string($connect, $_SESSION['lname']);
        $email = mysqli_real_escape_string($connect, $_SESSION['email']);
        $password = mysqli_real_escape_string($connect, $_SESSION['password']);
        $gender = mysqli_real_escape_string($connect, $_SESSION['gender']);
        $dateb = mysqli_real_escape_string($connect, $_SESSION['bday']);
        $img = 'noprofile.jpg'; // Default image
        $userid = rand(time(), 1000); // Generate user ID

        // Insert new account
        $sql1 = "INSERT INTO account (userid, fname, lname, email, password, img, gender, bdate) 
                VALUES ('$userid', '$fname', '$lname', '$email', '$password', '$img', '$gender', '$dateb')";
        
        if (mysqli_query($connect, $sql1)) {
            // Insert ranking
            $beginner = "INTERN";
            $ranking = "INSERT INTO ranking(rank_id,fname,lname,ranks) VALUES('$userid','$fname','$lname','$beginner')";
            $resultR = mysqli_query($connect, $ranking);

            // Insert user info
            $userinfo = "INSERT INTO userinfo(userid,fname,lname) VALUES('$userid','$fname','$lname')";
            $userRESULT = mysqli_query($connect, $userinfo);
            
            if ($resultR && $userRESULT) {
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'Account created successfully!'
                ));
            } else {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Secondary database insertions failed: ' . mysqli_error($connect)
                ));
            }
        } else {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Account creation failed: ' . mysqli_error($connect)
            ));
        }
    } else {
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Invalid OTP'
        ));
    }
    exit();
}

// Check if all required fields are filled for OTP generation
if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_POST['gender'], $_POST['bday'])) {
    $_SESSION['fname'] = $_POST['firstname'];
    $_SESSION['lname'] = $_POST['lastname'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['bday'] = $_POST['bday'];

    // Generate a random OTP
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;

    // Check if email already exists
    $sql2 = mysqli_query($connect, "SELECT * FROM account WHERE email = '{$_SESSION['email']}'");
    if (mysqli_num_rows($sql2) > 0) {
        echo json_encode(array(
            'status' => 'failed',
            'message' => 'Email already exists'
        ));
        exit();
    }

    // Send OTP to user's email
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'iquenxzx@gmail.com';
        $mail->Password = 'lews hdga hdvb glym'; // WARNING: Store passwords securely
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('iquenxzx@gmail.com', 'TechHub Team');
        $mail->addAddress($_SESSION['email'], $_SESSION['fname'] . ' ' . $_SESSION['lname']);

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = "Your OTP code is: $otp";

        $mail->send();
        echo json_encode(array(
            'status' => 'otp_sent',
            'message' => 'OTP sent to your email!'
        ));
    } catch (Exception $e) {
        error_log("Email sending failed: " . $mail->ErrorInfo);
        echo json_encode(array(
            'status' => 'error',
            'message' => 'OTP could not be sent.'
        ));
    }
    exit();
} else {
    echo json_encode(array(
        'status' => 'empty',
        'message' => 'Please fill in all required fields'
    ));
}
?>
