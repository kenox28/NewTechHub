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

function users() {
	document.getElementById("users").style.display = "block";
	console.log("hello");
	document.getElementById("POST").style.display = "none";
	loadUsers();
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
}

async function loadPost() {
	const res = await fetch("../php/post.php");
	const data = await res.json();
	let rows = "";
	for (let i = 0; i < data.length; i++) {
		const u = data[i];
		rows += `<div id="allpost" class="bg-white rounded-lg shadow-md overflow-hidden mb-4">
            <div class="feedname flex items-center p-4 border-b border-gray-200">
                <img src="../../profileimage/${u.img1}" alt="" class="homeprofile w-10 h-10 rounded-full object-cover mr-3" />
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
                <img src="../../profileimage/${u.imgpost}" alt="" id="postpic" class="w-full h-auto" />
            </div>
            <div class="flex items-center p-4 border-t border-gray-200">
                <button class="flex items-center mr-4 text-gray-600 hover:text-blue-500">
                    <i class="far fa-thumbs-up mr-1"></i>
                    <span>Like</span>
                </button>
                <button class="flex items-center text-gray-600 hover:text-red-500">
                    <i class="far fa-thumbs-down mr-1"></i>
                    <span>Dislike</span>
                </button>
            </div>
        </div>`;
	}
	document.getElementById("POST").innerHTML = rows;
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
	const res = await fetch("../php/deleteuserfromadmin.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
		},
		body: JSON.stringify({ userid }),
	});

	const data = await res.json();

	if (data.status === "success") {
		loadUsers();
	}
}
