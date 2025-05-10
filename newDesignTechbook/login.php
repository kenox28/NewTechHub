<?php
session_start();
// if wala naka login para no error mo balik sa loginpage
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
		<title>Login</title>
		<link rel="stylesheet" href="../css_techbook/login.css?v=1.0.2" />
		<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
		<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
			integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer" />
		<style>
				.forgot-input-group > div {
				transition: all 0.3s ease-in-out;
				opacity: 1;
			}

			.forgot-input-group > div[style*="display: none"] {
				opacity: 0;
				height: 0;
				overflow: hidden;
				margin: 0;
				padding: 0;
			}

			.forgot-input-group > div {
				margin-bottom: 15px;
			}

			#verificationCode {
				width: 120px;
				text-align: center;
				letter-spacing: 2px;
				font-size: 16px;
				margin: 0 auto;
				background: rgba(255, 255, 255, 0.1);
				border: none;
				border-radius: 4px;
				padding: 8px 12px;
				color: #fff;
			}

			#verificationSection .input-container {
				display: flex;
				flex-direction: column;
				align-items: center;
				justify-content: center;
			}

			.verification-message {
				color: #60A5FA;
				margin-top: 8px;
				font-size: 13px;
				text-align: center;
			}

			#verificationSection {
				display: flex;
				flex-direction: column;
				align-items: center;
				width: 100%;
			}

			#newPasswordSection .input-container {
				margin-bottom: 12px;
			}

			#newPasswordSection input {
				width: 90%;
				background: rgba(255, 255, 255, 0.1);
				border: none;
				border-radius: 4px;
				padding: 12px 15px;
				color: #fff;
				font-size: 14px;
				height: 95%;
			}

			#newPasswordSection input::placeholder {
				color: rgba(255, 255, 255, 0.5);
			}

			.input:focus {
				outline: none;
				box-shadow: 0 0 0 2px rgba(96, 165, 250, 0.3);
			}

			.input-container {
				width: 100%;
				max-width: 300px;
				margin: 0 auto;
			}

			.input-border {
				position: absolute;
				bottom: 0;
				left: 0;
				height: 2px;
				width: 0;
				background-color: #60A5FA;
				transition: width 0.3s ease;
			}

			.input:focus + .input-border {
				width: 100%;
			}

			#emailforgot {
				width: 90%;
				background: rgba(255, 255, 255, 0.1);
				border: none;
				border-radius: 4px;
				padding: 12px 15px;
				color: #fff;
				font-size: 14px;
				height: 95%;
			}

			#emailforgot::placeholder {
				color: rgba(255, 255, 255, 0.5);
			}

			.input {
				transition: all 0.3s ease;
			}

			.input:hover {
				background: rgba(255, 255, 255, 0.15);
			}

			#otpSection {
				position: relative;
			}

			#otpSection .verification-message {
				color: #60A5FA;
				font-size: 12px;
				margin-top: 5px;
				text-align: center;
			}

			#otp {
				width: 320px;
			}

			#otpSection .label {
				position: absolute;
				left: 10px;
				color: rgb(255, 255, 255);
				pointer-events: none;
				transition: 0.3s;
				font-size: 15px;
			}

			#otpSection .input:valid ~ .label,
			#otpSection .input:focus ~ .label {
				left: 0;
				font-size: 15px;
				padding-left: 10px;
			}
			#loginbtn,
			#loginbtn.verify-otp {
				display: flex;
				justify-content: center;
				padding: 12px; 
				margin: 0; 
			}
		</style>
	</head>

	<body>
		<form action="#" id="formforforgot">
			<div id="forbacka">
				<a href="#" id="backa">
					<i id="btnforback" class="fa-solid fa-xmark"></i>
				</a>
			</div>
			<div class="forgot-content">
				<div class="forgot-header">
					<div class="icon-wrapper">
						<i class="fas fa-lock forgot-icon"></i>
					</div>
					<h2>Forgot Password?</h2>
					<p>No worries! Enter your email and we'll send you password to your email.</p>
				</div>
				<div class="forgot-input-group">
					<!-- Email Section -->
					<div id="emailSection">
						<div class="input-container">
							<input type="email" name="email" id="emailforgot" class="input" required placeholder="name@example.com" />
							<span class="input-border"></span>
						</div>
					</div>
					
					<!-- Verification Code Section -->
					<div id="verificationSection" style="display: none;">
						<div class="input-container">
							<input type="text" name="verificationCode" id="verificationCode" class="input" placeholder="Enter 6-digit code" maxlength="6" pattern="[0-9]{6}" />
							<span class="input-border"></span>
							<div class="verification-message">Verification code has been sent to your email</div>
						</div>
					</div>

					<!-- New Password Section -->
					<div id="newPasswordSection" style="display: none;">
						<div class="input-container">
							<input type="password" name="newPassword" id="newPassword" class="input" placeholder="New Password" />
							<span class="input-border"></span>
						</div>
						<div class="input-container">
							<input type="password" name="confirmPassword" id="confirmPassword" class="input" placeholder="Confirm Password" />
							<span class="input-border"></span>
						</div>
					</div>
				</div>
				<button type="submit" id="btnfors" class="reset-button">
					<span>Send Code</span>
					<i class="fas fa-arrow-right"></i>
				</button>
				<div class="forgot-footer">
					<p>Remember your password? <a href="#" id="backtologin">Login here</a></p>
				</div>
			</div>
		</form>
		<div id="box1" data-aos="fade-right" data-aos-duration="1000">
			
		</div>
		<div id="box2" data-aos="fade-left" data-aos-duration="1000">
			<form action="#" id="formlogin" enctype="multipart/form-data">
				<div class="divinput" id="fnamediv">
					<div class="container">
						<input
							required=""
							type="email"
							name="email"
							id="username"
							class="input" />
						<label class="label">Email Account</label>
					</div>

					<div class="container">
						<input
							required=""
							type="password"
							name="password"
							id="passsword"
							class="input" />
						<label class="label">Password</label>
					</div>
					<div class="container" id="otpSection" style="display: none;">
						<input required="" type="text" name="otp" id="otp" class="input" maxlength="6" pattern="[0-9]{6}" />
						<label class="label">OTP Code</label>

					</div>
				</div>
				

				<!-- <input
                    type="email"
                    name="email"
                    id="username"
                    placeholder="Email or phone number" /> -->
				<!-- <input
                    type="password"
                    name="password"
                    id="passsword"
                    placeholder="Password" /> -->

				<div>
					<button type="submit" id="loginbtn" class="btn">
						<i class="animation"></i>LOG IN<i class="animation"></i>
					</button>
				</div>
				<!-- <input type="submit" value="Log in" id="loginbtn" class=""/> -->
				<hr />
				<div>
					<button class="btn" id="create">
						<i class="animation"></i>Create new account<i class="animation"></i>
					</button>
				</div>
				<div>
					<button class="btn" id="forgotbuton">
						<i class="animation"></i>Forgot Password<i class="animation"></i>
					</button>
				</div>
				<!-- <button id="create">Create new account</button> -->
				<!-- <a href="" id="create">createacc</a> -->
			</form>
		</div>
		<div>
			<!-- <form action="#" id="formforforgot">
                <label for="">FORGOT PASSWORD?</label>
                <input type="text" placeholder="Enter email account" />
                <div id="divforsubmit">
                    <button type="submit" id="btnfors" >SUBMIT</button>
                </div>
            </form> -->
		</div>
	</body>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script src="../techHUB_Javascripts/login.js"></script>
</html>
