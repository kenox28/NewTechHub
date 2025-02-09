const login = document.querySelector("#createAccount");
const logForm = document.querySelector("#createAccountForm");

logForm.onsubmit = function (e) {
	e.preventDefault();

	let xhr = new XMLHttpRequest();
	xhr.open("POST", "Create1.php", true);

	xhr.onload = function () {
		if (xhr.readyState === XMLHttpRequest.DONE) {
			if (xhr.status === 200) {
				let data;
				try {
					data = JSON.parse(xhr.responseText);

					switch (data.status) {
						case "failed":
							swal({
								title: "Error!",
								text: data.message,
								icon: "error",
								button: "Try Again",
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
		swal({
			title: "Error!",
			text: "Failed to connect to the server",
			icon: "error",
			button: "OK",
		});
	};

	let formdatainputed = new FormData(logForm);
	xhr.send(formdatainputed);
};
