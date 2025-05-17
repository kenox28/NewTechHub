AOS.init();

const create = document.querySelector("#create");
const form = document.querySelector("#formlogin");
const btn = form.querySelector("#loginbtn");

document.querySelectorAll(".btn").forEach((button) => {
	button.addEventListener("click", function (e) {
		let x = e.clientX - e.target.offsetLeft;
		let y = e.clientY - e.target.offsetTop;

		let ripple = document.createElement("span");
		ripple.className = "animation";
		ripple.style.left = x + "px";
		ripple.style.top = y + "px";

		this.appendChild(ripple);

		setTimeout(() => {
			ripple.remove();
		}, 600);
	});
});
create.onclick = function gocreate(e) {
	e.preventDefault();
	window.location.href = "../newDesignTechbook/createform.php";
};

form.onsubmit = function sendajax(e) {
	e.preventDefault();
};

btn.onclick = function send(e) {
	e.preventDefault();
	const username = document.querySelector("#username").value;
	const passsword = document.querySelector("#passsword").value;

	let xhr = new XMLHttpRequest();
	xhr.open("POST", "../newPhpfileTechhub/loginValidation.php", true);
	xhr.onload = function () {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				try {
					let response = JSON.parse(xhr.response);
					if (response.status === "success") {
						if (response.role === "admin") {
							location.href = "../admin/views/homepage.php";
						} else {
							location.href = "../newDesignTechbook/home.php";
						}
					} else {
						swal({
							title: "Login Failed!",
							text:
								response.message ||
								"Invalid email or password. Please try again.",
							icon: "error",
							button: "OK",
						});
					}
				} catch (e) {
					swal({
						title: "Error!",
						text: "An error occurred. Please try again.",
						icon: "error",
						button: "OK",
					});
				}
			}
		}
	};
	let formData = new FormData();
	formData.append("email", username);
	formData.append("password", passsword);
	formData.append("action", "login");
	xhr.send(formData);
};
const forgotbuton = document.querySelector("#forgotbuton");
const formforforgot = document.querySelector("#formforforgot");
const backa = document.querySelector("#backa");
const backtologin = document.querySelector("#backtologin");
const mainContent = document.querySelector("#box2");

// Show forgot password form
function showForgotForm() {
	formforforgot.style.display = "block";
	// Small delay to ensure display:block is applied before adding active class
	requestAnimationFrame(() => {
		formforforgot.classList.add("active");
		mainContent.classList.add("blur-background");
	});
}

// Hide forgot password form
function hideForgotForm() {
	formforforgot.classList.remove("active");
	mainContent.classList.remove("blur-background");
	// Wait for animation to complete before hiding
	setTimeout(() => {
		formforforgot.style.display = "none";
	}, 300);
}

// Event Listeners
forgotbuton.onclick = function (e) {
	e.preventDefault();
	showForgotForm();
};

backa.onclick = function (e) {
	e.preventDefault();
	hideForgotForm();
};

// Close on outside click
document.addEventListener("click", function (e) {
	if (
		formforforgot.classList.contains("active") &&
		!formforforgot.contains(e.target) &&
		!forgotbuton.contains(e.target)
	) {
		hideForgotForm();
	}
});

const emailInput = document.querySelector("#emailforgot");
const submitBtn = document.querySelector("#btnfors");

formforforgot.onsubmit = function (e) {
	e.preventDefault();

	const email = emailInput.value;
	const emailSection = document.getElementById("emailSection");
	const verificationSection = document.querySelector("#verificationSection");
	const newPasswordSection = document.querySelector("#newPasswordSection");
	const verificationCode = document.querySelector("#verificationCode");
	const newPassword = document.querySelector("#newPassword");
	const confirmPassword = document.querySelector("#confirmPassword");

	// Basic email validation
	if (!email || !email.includes("@")) {
		swal({
			title: "Invalid Email",
			text: "Please enter a valid email address",
			icon: "warning",
			button: "OK",
		});
		return;
	}

	// Show loading state
	submitBtn.disabled = true;

	// If email section is visible, send verification code
	if (emailSection.style.display !== "none") {
		submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';

		const formData = new FormData();
		formData.append("action", "send_code");
		formData.append("email", email);

		fetch("../newPhpfileTechhub/forgotpass.php", {
			method: "POST",
			body: formData,
		})
			.then((response) => response.text())
			.then((text) => {
				console.log("Raw response:", text);
				try {
					return JSON.parse(text);
				} catch (e) {
					console.error("Failed to parse JSON:", text);
					throw new Error("Server returned invalid JSON");
				}
			})
			.then((data) => {
				if (data.status === "success") {
					emailSection.style.display = "none";
					verificationSection.style.display = "block";
					submitBtn.innerHTML =
						'<span>Verify Code</span><i class="fas fa-arrow-right"></i>';
				} else {
					throw new Error(data.message || "Failed to send verification code");
				}
			})
			.catch((error) => {
				console.error("Error details:", error);
				swal({
					title: "Error!",
					text: error.message || "An error occurred",
					icon: "error",
					button: "OK",
				});
			})
			.finally(() => {
				submitBtn.disabled = false;
			});
	}
	// If verification section is visible, verify code
	else if (verificationSection.style.display !== "none") {
		if (!verificationCode.value) {
			swal({
				title: "Error!",
				text: "Please enter the verification code",
				icon: "error",
				button: "OK",
			});
			return;
		}

		submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Verifying...';

		const formData = new FormData();
		formData.append("action", "verify_code");
		formData.append("email", email);
		formData.append("verification_code", verificationCode.value);

		fetch("../newPhpfileTechhub/forgotpass.php", {
			method: "POST",
			body: formData,
		})
			.then((response) => response.text())
			.then((text) => {
				console.log("Raw response:", text);
				try {
					return JSON.parse(text);
				} catch (e) {
					console.error("Failed to parse JSON:", text);
					throw new Error("Server returned invalid JSON");
				}
			})
			.then((data) => {
				if (data.status === "success") {
					verificationSection.style.display = "none";
					newPasswordSection.style.display = "block";
					submitBtn.innerHTML =
						'<span>Reset Password</span><i class="fas fa-arrow-right"></i>';
				} else {
					throw new Error(data.message);
				}
			})
			.catch((error) => {
				swal({
					title: "Error!",
					text: error.message || "Invalid verification code",
					icon: "error",
					button: "OK",
				});
			})
			.finally(() => {
				submitBtn.disabled = false;
			});
	}
	// If password section is visible, reset password
	else if (newPasswordSection.style.display !== "none") {
		if (!newPassword.value || !confirmPassword.value) {
			swal({
				title: "Error!",
				text: "Please fill in both password fields",
				icon: "error",
				button: "OK",
			});
			return;
		}

		if (newPassword.value !== confirmPassword.value) {
			swal({
				title: "Error!",
				text: "Passwords do not match",
				icon: "error",
				button: "OK",
			});
			return;
		}

		submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Resetting...';

		const formData = new FormData();
		formData.append("action", "reset_password");
		formData.append("email", email);
		formData.append("verification_code", verificationCode.value);
		formData.append("new_password", newPassword.value);

		fetch("../newPhpfileTechhub/forgotpass.php", {
			method: "POST",
			body: formData,
		})
			.then((response) => response.text())
			.then((text) => {
				console.log("Raw response:", text);
				try {
					return JSON.parse(text);
				} catch (e) {
					console.error("Failed to parse JSON:", text);
					throw new Error("Server returned invalid JSON");
				}
			})
			.then((data) => {
				if (data.status === "success") {
					swal({
						title: "Success!",
						text: "Your password has been reset successfully",
						icon: "success",
						button: "OK",
					}).then(() => {
						// Reset form and hide it
						formforforgot.reset();
						hideForgotForm();

						// Reset all sections to their initial state
						emailSection.style.display = "block";
						verificationSection.style.display = "none";
						newPasswordSection.style.display = "none";
						submitBtn.innerHTML =
							'<span>Send Code</span><i class="fas fa-arrow-right"></i>';
					});
				} else {
					throw new Error(data.message);
				}
			})
			.catch((error) => {
				swal({
					title: "Error!",
					text: error.message || "Failed to reset password",
					icon: "error",
					button: "OK",
				});
			})
			.finally(() => {
				submitBtn.disabled = false;
			});
	}
};
