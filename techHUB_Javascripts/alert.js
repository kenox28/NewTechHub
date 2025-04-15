const login = document.querySelector("#login");
const logForm = document.querySelector("#logForm");
const otpSendContent = document.querySelector("#OTPSend-content");

// Initially disable the submit button
login.disabled = true;

logForm.onsubmit = function (e) {
	e.preventDefault();
};

login.onclick = function (e) {
	e.preventDefault();

	// Check if reCAPTCHA is completed
	const captchaResponse = grecaptcha.getResponse();
	if (!captchaResponse) {
		swal({
			title: "Warning!",
			text: "Please complete the reCAPTCHA",
			icon: "warning",
			button: "OK",
		});
		return;
	}

	let xhr = new XMLHttpRequest();
	xhr.open("POST", "../newPhpfileTechhub/createacc.php", true);

	xhr.onload = function () {
		console.log("Raw Response:", xhr.responseText); // Debug line

		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				let data;
				try {
					data = JSON.parse(xhr.responseText);
					console.log("Parsed data:", data); // Debug line

					switch (data.status) {
						case "failed":
							swal({
								title: "Error!",
								text: data.message,
								icon: "error",
								button: "Try Again",
							});
							break;

						case "otp_sent":
							// Show the OTP input section
							otpSendContent.style.display = "block";
							swal({
								title: "OTP Sent!",
								text: "Please check your email for the OTP.",
								icon: "success",
								button: "OK",
							});
							break;

						case "success":
							swal({
								title: "Success!",
								text: data.emailError
									? "Account created successfully!\n" + data.emailError
									: "Account created successfully!",
								icon: "success",
								button: "Continue",
							}).then(() => {
								window.location.href = "../newDesignTechbook/createform.php";
							});
							break;

						case "empty":
							swal({
								title: "Warning!",
								text: data.message,
								icon: "warning",
								button: "OK",
							});
							break;

						default:
							swal({
								title: "Error!",
								text: data.message || "An unexpected error occurred",
								icon: "error",
								button: "OK",
							});
					}
				} catch (e) {
					console.error("JSON Parse Error:", e);
					console.log("Response Text:", xhr.responseText);
					swal({
						title: "Error!",
						text: "An unexpected error occurred while processing the response",
						icon: "error",
						button: "OK",
					});
				}
			}
		}
	};

	xhr.onerror = function () {
		console.error("Request failed:", xhr.statusText);
		swal({
			title: "Error!",
			text: "Failed to connect to the server",
			icon: "error",
			button: "OK",
		});
	};

	let formdatainputed = new FormData(logForm);
	formdatainputed.append("g-recaptcha-response", captchaResponse);
	xhr.send(formdatainputed);
};

// OTP verification logic
document.querySelector("#verifyOTP").onclick = function () {
	const otpValue = document.querySelector("#OTP").value;

	// Send OTP for verification
	let otpXhr = new XMLHttpRequest();
	otpXhr.open("POST", "../newPhpfileTechhub/createacc.php", true);
	otpXhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	otpXhr.onload = function () {
		let otpData = JSON.parse(otpXhr.responseText);
		if (otpData.status === "error") {
			swal({
				title: "Error!",
				text: otpData.message,
				icon: "error",
				button: "OK",
			});
		} else if (otpData.status === "success") {
			swal({
				title: "Success!",
				text: otpData.message,
				icon: "success",
				button: "Continue",
			}).then(() => {
				window.location.href = "../newDesignTechbook/createform.php";
			});
		}
	};
	otpXhr.send(`OTP=${otpValue}`);
};

// Functions for reCAPTCHA
function enablesubmit() {
	login.disabled = false;
}

function recaptchaExpired() {
	login.disabled = true;
}

document.querySelector("#close-icon").onclick = function () {
	otpSendContent.style.display = "none";
};
