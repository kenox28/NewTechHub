<?php
session_start();
// Clear any existing session when on create account page
session_unset();
session_destroy();

// Original redirect check
if (isset($_SESSION['userid'])) {
    header("location:home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Create Account</title>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="min-h-screen bg-gradient-to-br from-[#5eead4] to-[#3b82f6] relative">
        <div id="box2" class="absolute left-20 top-1/2 transform -translate-y-1/2">
            <!-- <img src="../profileimage/techuboragnelogo.png" alt="" /> -->
        </div>

        <div id="box1" class="absolute right-20 top-1/2 transform -translate-y-1/2 bg-white w-full max-w-md p-6 rounded-2xl shadow-lg space-y-6">
            <form action="#" id="logForm" class="space-y-4" enctype="multipart/form-data">
                <div class="divinput">
                    <h1 class="text-3xl font-semibold text-gray-800 text-center">CREATE ACCOUNT</h1>
                </div>

                <div class="divinput" id="fnamediv">
                    <div class="flex space-x-4">
                        <div class="container flex-1">
                            <label class="block text-sm font-medium text-gray-700">First Name</label>
                            <input required type="text" name="firstname" class="input w-full mt-1 p-2 border border-gray-300 rounded-md" id="firstname" />
                        </div>
                        <div class="container flex-1">
                            <label class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input required type="text" name="lastname" class="input w-full mt-1 p-2 border border-gray-300 rounded-md" id="lastname" />
                        </div>
                    </div>
                </div>

                <div class="divinput" id="Userdiv">
                    <div class="container">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input required type="email" name="email" class="input w-full mt-1 p-2 border border-gray-300 rounded-md" id="email" />
                    </div>
                </div>

                <div class="divinput" id="Passdiv">
                    <div class="container">
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input required type="password" name="password" class="input w-full mt-1 p-2 border border-gray-300 rounded-md" id="password" />
                    </div>
                </div>

                <div class="imagediv" id="imagediv">
                    <div class="divgender space-y-4">
                        <div class="container">
                            <label class="block text-sm font-medium text-gray-700">Birthdate</label>
                            <input required type="date" name="bday" class="input w-full mt-1 p-2 border border-gray-300 rounded-md" id="dateb" />
                        </div>
                        
                        <div class="radio-button-container flex space-x-4 items-center">
                            <label class="text-sm font-medium text-gray-700">Gender:</label>
                            <div class="radio-button">
                                <input type="radio" class="radio-button__input text-blue-500" id="radio1" name="gender" value="Male" />
                                <label class="radio-button__label" for="radio1">
                                    <span class="radio-button__custom"></span>
                                    MALE
                                </label>
                            </div>
                            <div class="radio-button">
                                <input type="radio" class="radio-button__input text-pink-500" id="radio2" name="gender" value="Female" />
                                <label class="radio-button__label" for="radio2">
                                    <span class="radio-button__custom"></span>
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="radio-button hidden">
                        <input type="file" id="idimage" name="img" class="input" hidden />
                    </div>
                </div>

                <div class="g-recaptcha" data-sitekey="6LdX5ZMqAAAAAF13Y34OElEmylNdemrlEYzM_f2V" data-callback="enablesubmit" data-expired-callback="recaptchaExpired"></div>

                <div class="divinput" id="divcreatebtn">
                    <button class="btn w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-500 transition duration-300" id="login" type="submit">
                        <i class="animation"></i>Create new account<i class="animation"></i>
                    </button>
                </div>

                <hr class="my-4" />

                <div id="linklog" class="text-center text-sm text-gray-600">
                    <label for="golog">Already have an account?</label>
                    <a href="login.php" id="golog" class="text-blue-500 hover:underline">Login</a>
                </div>
            </form>
        </div>

        <div id="OTPSend-content" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-lg shadow-lg hidden" style="width: 300px;">
            <span id="close-icon" class="absolute top-2 right-3 text-gray-500 text-xl cursor-pointer">&times;</span>
            <h2 class="text-lg font-semibold mb-4" id="OTP-title">Email Verification</h2>
            <input type="text" id="OTP" name="OTP" placeholder="Enter OTP" class="w-full p-2 border border-gray-300 rounded-md mb-4" />
            <button id="verifyOTP" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Verify OTP</button>
        </div>

        <script src="../techHUB_Javascripts/alert.js?v=1.0.1"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>
</html>