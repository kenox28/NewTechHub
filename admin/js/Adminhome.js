// Initialize the dashboard
document.addEventListener("DOMContentLoaded", function () {
	homepage(); // Show posts by default
	loadRanks(); // Load user stats
});

function homepage() {
	document.getElementById("users").style.display = "none";
	console.log("hello");
	document.getElementById("POST").style.display = "block";
	loadPost();
}

// Function to load homepage statistics
async function loadHomepageStats() {
	try {
		const res = await fetch("../php/count_stats.php");
		const data = await res.json();

		// Display the stats in the POST section at the top
		const statsHtml = `
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
			<div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-blue-500">
				<div class="flex items-center">
					<div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
						<i class="fas fa-users text-xl"></i>
					</div>
					<div>
						<p class="text-gray-500 text-sm">Total Users</p>
						<h1 class="text-3xl font-bold">${data.total_users}</h1>
					</div>
				</div>
			</div>
			<div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-green-500">
				<div class="flex items-center">
					<div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
						<i class="fas fa-newspaper text-xl"></i>
					</div>
					<div>
						<p class="text-gray-500 text-sm">Total Posts</p>
						<h1 class="text-3xl font-bold">${data.total_posts}</h1>
					</div>
				</div>
			</div>
			<div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-yellow-500">
				<div class="flex items-center">
					<div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
						<i class="fas fa-flag text-xl"></i>
					</div>
					<div>
						<p class="text-gray-500 text-sm">Total Reports</p>
						<h1 class="text-3xl font-bold">${data.total_reports}</h1>
					</div>
				</div>
			</div>
			<div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-purple-500">
				<div class="flex items-center">
					<div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-4">
						<i class="fas fa-comment text-xl"></i>
					</div>
					<div>
						<p class="text-gray-500 text-sm">Total Feedback</p>
						<h1 class="text-3xl font-bold">${data.total_feedback}</h1>
					</div>
				</div>
			</div>
		</div>`;

		// Prepend stats to the POST section
		const postSection = document.getElementById("POST");
		postSection.innerHTML = statsHtml + postSection.innerHTML;
	} catch (error) {
		console.error("Error loading homepage stats:", error);
	}
}

async function loadPost() {
	const res = await fetch("../php/post.php");
	const data = await res.json();
	let rows = "";
	for (let i = 0; i < data.length; i++) {
		const u = data[i];
		rows += `<div id="allpost" class="bg-white rounded-lg shadow-md overflow-hidden mb-4">
            <div class="feedname flex items-center p-4 border-b border-gray-200">
                <img src="../../profileimage/${
									u.img1
								}" alt="" class="homeprofile w-10 h-10 rounded-full object-cover mr-3" />
                <h1 id="Postname" class="font-semibold">
                    ${u.fname} ${u.lname}
                </h1>
            </div>
            <div class="Postcaption p-4">
                <p id="Postcaption" class="text-gray-700">
                    ${u.cappost}
                </p>
            </div>
            <div class="postpic">
                <img src="../../profileimage/${
									u.imgpost
								}" alt="" id="postpic" class="w-full h-auto" />
            </div>
            <div class="flex items-center p-4 border-t border-gray-200">
                <button onclick="reactPost(${u.id}, 'up')" 
                        type="button" 
                        id="upbtn_${u.id}" 
                        class="flex items-center mr-4 text-gray-600 hover:text-blue-500 vote-btn ${
													u.upvoted ? "voted" : ""
												}">
                    <i class="far fa-thumbs-up mr-1"></i>
                    <span>Like</span>
                </button>
                <button onclick="reactPost(${u.id}, 'down')" 
                        type="button" 
                        id="downbtn_${u.id}" 
                        class="flex items-center text-gray-600 hover:text-red-500 vote-btn ${
													u.downvoted ? "voted" : ""
												}">
                    <i class="far fa-thumbs-down mr-1"></i>
                    <span>Dislike</span>
                </button>
                <p id="likes_${u.id}" class="vote-count ml-4">Votes: ${
			u.react
		}</p>
            </div>
        </div>`;
	}
	document.getElementById("POST").innerHTML = rows;

	// Load homepage stats after loading posts
	loadHomepageStats();
}

function reactPost(postId, voteType = "up") {
	const buttonId = (voteType === "up" ? "upbtn_" : "downbtn_") + postId;
	const button = document.getElementById(buttonId);

	// Prevent the user from voting more than once
	if (button.classList.contains("voted")) {
		return;
	}

	// Disable the buttons to prevent further clicks
	document.getElementById("upbtn_" + postId).classList.add("disabled");
	document.getElementById("downbtn_" + postId).classList.add("disabled");

	fetch("../../../newPhpfileTechhub/likes.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/x-www-form-urlencoded",
		},
		body: `postid=${postId}&vote=${voteType}`,
	})
		.then((response) => response.json())
		.then((data) => {
			if (data.success) {
				document.getElementById("likes_" + postId).innerHTML =
					"Votes: " + data.newCount;

				button.classList.add("voted");

				if (voteType === "up") {
					document
						.getElementById("upbtn_" + postId)
						.querySelector("i").style.color = "#2ecc71"; // green
				} else {
					document
						.getElementById("downbtn_" + postId)
						.querySelector("i").style.color = "#e74c3c"; // red
				}
			} else {
				console.error("Error: " + data.message);
			}
		})
		.catch((error) => console.error("Error:", error));
}

async function loadRanks() {
	const res = await fetch("../php/count.php");
	const data = await res.json();

	document.getElementById("beginner").textContent = data.beginners;
	document.getElementById("intermediate").textContent = data.Intermediate;
	document.getElementById("advanced").textContent = data.Advanced;
	document.getElementById("expert").textContent = data.expert;
}

async function deleteUser(userid) {
	console.log("Trying to delete user with ID:", userid);

	const res = await fetch("../php/deleteuserfromadmin.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify({ userid }),
	});

	const data = await res.json();

	console.log("Delete response data:", data); // Log response data

	if (data.status === "success") {
		loadUsers();
	} else {
		console.log("Delete failed:", data.message);
	}
}

function reports() {
	window.location.href = "../views/reports.php";
}
function users() {
	// document.getElementById("users").style.display = "block";
	// console.log("hello");
	// document.getElementById("POST").style.display = "none";
	// loadUsers();
	window.location.href = "../views/users.php";
}
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
			<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${u.password}</td>
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
