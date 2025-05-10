async function getUsers() {
	try {
		const response = await fetch(
			"192.168.254.100:3000/techhub2sirmorps/post.php",
			{
				method: "POST",
				headers: {
					"Content-Type": "application/x-www-form-urlencoded",
				},
				body: "action=GET_users",
			}
		);

		const data = await response.json();

		if (data.status === "success") {
			console.log("Users fetched:", data.users);

			data.users.forEach((user) => {
				const div = document.createElement("div");
				div.textContent = `${user.fname} ${user.lname}`;
				document.body.appendChild(div);

				insertUser(user); // call insert function separately
			});
		} else {
			console.error("Error:", data.message);
		}
	} catch (error) {
		console.error("Fetch error:", error);
	}
}

async function insertUser(user) {
	try {
		const response = await fetch("insert.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded",
			},
			body: new URLSearchParams({
				email: user.email,
				fname: user.fname,
				password: user.password,
				profile_img: user.img,
			}),
		});

		const result = await response.json();
		console.log("Insert result:", result);
	} catch (error) {
		console.error("Insert error:", error);
	}
}

getUsers();
