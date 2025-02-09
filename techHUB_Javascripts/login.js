AOS.init();

const create = document.querySelector("#create");
const form = document.querySelector("#formlogin");
const btn = form.querySelector("#loginbtn");
create.onclick = function gocreate(e) {
	e.preventDefault();
	window.location.href = "../newDesignTechbook/createform.php";
};

form.onsubmit = function sendajax(e) {
	e.preventDefault();
};
btn.onclick = function send(e) {
	const username = document.querySelector("#username").value;
	const passsword = document.querySelector("#passsword").value;

	e.preventDefault();
	let xhr = new XMLHttpRequest();
	xhr.open("POST", "../newPhpfileTechhub/loginValidation.php", true);
	xhr.onload = function () {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				let data = xhr.response;
				if (data === "success") {
					location.href = "../newDesignTechbook/home.php";
				} else if (data === "admin") {
					location.href = "adminhomepage.php";
				} else {
					// Show error message for invalid credentials
					swal({
						title: "Login Failed!",
						text: "Invalid email or password. Please try again.",
						icon: "error",
						button: "OK",
					});
				}
			}
		}
	};
	let formdatainputed = new FormData(form);
	xhr.send(formdatainputed);
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

	// Get email value
	const email = emailInput.value;

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
	submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
	submitBtn.disabled = true;

	// Create FormData
	let formData = new FormData();
	formData.append("email", email);

	// Send AJAX request
	fetch("../newPhpfileTechhub/forgotpass.php", {
		method: "POST",
		body: formData,
	})
		.then((response) => response.json())
		.then((data) => {
			if (data.status === "success") {
				swal({
					title: "Success!",
					text: data.message,
					icon: "success",
					button: "OK",
				}).then(() => {
					formforforgot.reset();
					hideForgotForm();
				});
			} else {
				swal({
					title: "Error!",
					text: data.message || "An error occurred",
					icon: "error",
					button: "OK",
				});
			}
		})
		.catch((error) => {
			console.error("Error:", error);
			swal({
				title: "Error!",
				text: "An error occurred while processing your request",
				icon: "error",
				button: "OK",
			});
		})
		.finally(() => {
			// Reset button state
			submitBtn.innerHTML =
				'<span>Send Password</span><i class="fas fa-arrow-right"></i>';
			submitBtn.disabled = false;
		});
};
