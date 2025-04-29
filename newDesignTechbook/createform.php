
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
		<link rel="stylesheet" href="../css_techbook/create1.css?v=1.0.5" />
	</head>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

<!-- Initialize EmailJS -->
	<!-- <script type="text/javascript">
		(function() {
			emailjs.init("DvupqWcqhjzEECjbx"); // Replace with your actual public key
		})();
	</script> -->
	<body class="min-h-screen flex flex-col md:flex-row items-center justify-center bg-gradient-to-br from-gray-800 via-gray-900 to-black p-4 md:p-8">
		<div id="box2">
			<!-- <img src="../profileimage/techuboragnelogo.png" alt="" /> -->
		</div>
		<div id="box1">
			<form action="#" id="logForm" enctype="multipart/form-data">
				<div class="divinput">
					<h1>CREATE ACCOUNT</h1>
				</div>
				<div class="divinput" id="fnamediv">
					<div class="container">
						<input
							required=""
							type="text"
							name="firstname"
							class="input"
							id="firstname" />
						<label class="label">First name</label>
					</div>

					<div class="container">
						<input
							required=""
							type="text"
							name="lastname"
							class="input"
							id="lastname" />
						<label class="label">Last name</label>
					</div>
				</div>
				<div class="divinput" id="Userdiv">
					<div class="container">
						<input
							required=""
							type="email"
							name="email"
							class="input"
							id="email" />
						<label class="label">Email</label>
					</div>
				</div>
				<div class="divinput" id="Passdiv">
					<div class="container">
						<input
							required=""
							type="password"
							name="password"
							class="input"
							id="password" />
						<label class="label">Password</label>
					</div>
				</div>
				<div class="imagediv" id="imagediv">
					<div class="divgender">
						<!-- <input type="date" id="dateb" name="bday" /> -->
						<div class="container">
							<input
								required=""
								require
								type="date"
								name="bday"
								class="input"
								id="dateb" />
							<!-- <label class="label"></label> -->
						</div>
						<div class="radio-button-container">
							<div class="radio-button">
								<input
									type="radio"
									class="radio-button__input"
									id="radio1"
									name="gender"
									value="Male" />
								<label class="radio-button__label" for="radio1">
									<span class="radio-button__custom"></span>
									MALE
								</label>
							</div>
							<div class="radio-button">
								<input
									type="radio"
									class="radio-button__input"
									id="radio2"
									name="gender"
									value="Female" />
								<label class="radio-button__label" for="radio2">
									<span class="radio-button__custom"></span>
									Female
								</label>
							</div>
						</div>
					</div>
					<div class="radio-button">
						<input type="file"  id="idimage" name="img" class="input" hidden />
					</div>
				</div>
				<div class="g-recaptcha" data-sitekey="6LdX5ZMqAAAAAF13Y34OElEmylNdemrlEYzM_f2V" data-callback="enablesubmit" data-expired-callback="recaptchaExpired"></div>
				<div class="divinput" id="divcreatebtn">
					<button class="btn" id="login" type="submit">
						<i class="animation"></i>Create new account<i class="animation"></i>
					</button>
				</div>

				<hr />
				<div id="linklog">
					<label for="golog">Already have an account?</label>
					<a href="login.php" id="golog">Login</a>
				</div>
			</form> 
		</div>
		<div id="OTPSend-content" style="display: none;">
			<span id="close-icon" style="cursor: pointer; position: absolute; top: 10px; right: 10px; font-size: 20px; color: #ffffff;">&times;</span>
			<h1 id="OTP-title">Email Verification</h1>
			<input type="text" id="OTP" name="OTP" placeholder="Enter OTP" />
			<button id="verifyOTP">Verify OTP</button>
		</div>

		<script src="../techHUB_Javascripts/alert.js?v=1.0.1"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	</body>
</html>
