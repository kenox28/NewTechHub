// Your existing JavaScript functions
async function loadUsers() {
	const res = await fetch("../php/fetchuser.php");
	const data = await res.json();
	let rows = "";
	for (let i = 0; i < data.length; i++) {
		const u = data[i];
		rows += `<tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${u.userid}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${u.fname}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${u.lname}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${u.email}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
                <a href="#" onclick="deleteUser(${u.userid})" class="text-red-600 hover:text-red-900">
                    <i class="fas fa-trash"></i> Delete
                </a>
            </td>
        </tr>`;
	}
	document.getElementById("userTableBody").innerHTML = rows;
	document.getElementById("totalUsers").textContent = data.length;
	document.getElementById("endCount").textContent = Math.min(data.length, 10);
}

async function deleteUser(userid) {
	console.log("Trying to delete user with ID:", userid);

	if (!confirm("Are you sure you want to delete this user?")) {
		return;
	}

	const res = await fetch("../php/deleteuserfromadmin.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify({ userid }),
	});

	const data = await res.json();
	console.log("Delete response data:", data);

	if (data.status === "success") {
		loadUsers();
		loadRanks(); // Refresh rank counts after deletion
	} else {
		console.log("Delete failed:", data.message);
		alert("Failed to delete user: " + data.message);
	}
}

// Search functionality
document.getElementById("searchUser").addEventListener("input", function (e) {
	const searchTerm = e.target.value.toLowerCase();
	const rows = document.querySelectorAll("#userTableBody tr");

	rows.forEach((row) => {
		const text = row.textContent.toLowerCase();
		if (text.includes(searchTerm) || searchTerm === "") {
			row.style.display = "";
		} else {
			row.style.display = "none";
		}
	});
});

// Modal functions
function openModal() {
	document.getElementById("addUserModal").classList.remove("hidden");
	document.getElementById("addUserModal").classList.add("flex");
}

function closeModal() {
	document.getElementById("addUserModal").classList.add("hidden");
	document.getElementById("addUserModal").classList.remove("flex");
}

// Add event listener to the "Add User" button
document.getElementById("addUserBtn").addEventListener("click", openModal);

// Form submission
document
	.getElementById("addUserForm")
	.addEventListener("submit", async function (e) {
		e.preventDefault();

		const userData = {
			fname: document.getElementById("firstName").value,
			lname: document.getElementById("lastName").value,
			email: document.getElementById("email").value,
			password: document.getElementById("password").value,
		};

		// You would need to create this endpoint
		try {
			const res = await fetch("../php/adduser.php", {
				method: "POST",
				headers: {
					"Content-Type": "application/json",
				},
				body: JSON.stringify(userData),
			});

			const data = await res.json();

			if (data.status === "success") {
				alert("User added successfully!");
				closeModal();
				loadUsers(); // Reload users
				loadRanks(); // Reload rank counts
			} else {
				alert("Failed to add user: " + data.message);
			}
		} catch (error) {
			console.error("Error adding user:", error);
			alert("An error occurred while adding the user");
		}
	});

// Navigation functions (skeleton)
function homepage() {
	window.location.href = "../views/homepage.php";
}

function users() {
	// Already on users page
}

function reports() {
	window.location.href = "../views/reports.php";
}

// Load data when page loads
document.addEventListener("DOMContentLoaded", function () {
	loadUsers();
	loadRanks();
});

// Enhanced loadRanks function with animation
async function loadRanks() {
	try {
		const res = await fetch("../php/count.php");
		if (!res.ok) {
			throw new Error(`HTTP error! Status: ${res.status}`);
		}

		const data = await res.json();

		// Store the target values
		const targets = {
			beginner: parseInt(data.beginners) || 0,
			intermediate: parseInt(data.Intermediate) || 0,
			advanced: parseInt(data.Advanced) || 0,
			expert: parseInt(data.expert) || 0,
		};

		// Animate the counters
		animateCounter("beginner", targets.beginner);
		animateCounter("intermediate", targets.intermediate);
		animateCounter("advanced", targets.advanced);
		animateCounter("expert", targets.expert);
	} catch (error) {
		console.error("Error fetching rank data:", error);
		// Set counters to 0 if there's an error
		document.getElementById("beginner").textContent = "0";
		document.getElementById("intermediate").textContent = "0";
		document.getElementById("advanced").textContent = "0";
		document.getElementById("expert").textContent = "0";
	}
}

// Function to animate counter from current to target value
function animateCounter(id, targetValue) {
	const element = document.getElementById(id);
	const startValue = parseInt(element.textContent) || 0;
	const duration = 1000; // Animation duration in milliseconds
	const frameRate = 30; // Updates per second
	const totalFrames = duration / (1000 / frameRate);
	const increment = (targetValue - startValue) / totalFrames;

	let currentValue = startValue;
	let frame = 0;

	// Clear any existing animation
	if (element.countInterval) {
		clearInterval(element.countInterval);
	}

	// If the values are the same, no need to animate
	if (startValue === targetValue) {
		return;
	}

	// Start the animation
	element.countInterval = setInterval(() => {
		frame++;
		currentValue += increment;

		// Ensure we display integers only
		element.textContent = Math.round(currentValue);

		// Stop the animation when we've reached total frames or the target value
		if (
			frame >= totalFrames ||
			(increment > 0 && currentValue >= targetValue) ||
			(increment < 0 && currentValue <= targetValue)
		) {
			clearInterval(element.countInterval);
			element.textContent = targetValue; // Ensure we end exactly at the target
		}
	}, 1000 / frameRate);
}

// Auto refresh rank data every 5 minutes
function setupRankRefresh() {
	// Initial load already handled by DOMContentLoaded

	// Refresh every 5 minutes
	setInterval(loadRanks, 5 * 60 * 1000);
}

// Call the auto refresh setup when page loads
document.addEventListener("DOMContentLoaded", function () {
	// Your existing loadUsers() and loadRanks() are already called

	// Setup auto-refresh
	setupRankRefresh();

	// Add this line if you want a refresh button functionality
	const refreshStatsBtn = document.getElementById("refreshStats");
	if (refreshStatsBtn) {
		refreshStatsBtn.addEventListener("click", loadRanks);
	}
});

/////////////////////////////////////////////////////
function homepage() {
	window.location.href = "../views/homepage.php";
}
function users() {
	window.location.href = "../views/users.php";
}
function leaderboard() {
	window.location.href = "../views/leaderboard.php";
}
function reports() {
	window.location.href = "../views/reports.php";
}
function feedback() {
	window.location.href = "../views/feedback.php";
}
document.getElementById("logoutBtn").addEventListener("click", function () {
	// Optional: Clear session or localStorage if used
	// sessionStorage.clear();
	// localStorage.clear();

	// Redirect to login page and replace history

	window.location.replace("/newPhpfileTechhub/logout.php"); // Change this to your actual login page
});
