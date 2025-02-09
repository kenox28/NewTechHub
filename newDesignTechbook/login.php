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
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
			integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer" />
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
					<div class="input-container">
						<!-- <i class="fas fa-envelope"></i> -->
						<input type="email" name="email" id="emailforgot" class="input" required placeholder="name@example.com" />
						<span class="input-border"></span>
					</div>
				</div>
				<button type="submit" id="btnfors" class="reset-button">
					<span>Send Password</span>
					<i class="fas fa-arrow-right"></i>
				</button>
				<div class="forgot-footer">
					<p>Remember your password?</p>
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
						<label class="label">Email Acoount</label>
					</div>

					<div class="container">
						<input
							required=""
							type="password"
							name="password"
							id="passsword"
							class="input" />
						<label class="label">Passowrd</label>
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
