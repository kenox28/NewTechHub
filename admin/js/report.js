async function loadReports() {
	try {
		const response = await fetch("/admin/php/reports.php");
		if (!response.ok) {
			throw new Error(`HTTP error! Status: ${response.status}`);
		}

		const data = await response.json();
		let rows = "";

		if (data.length === 0) {
			rows = `<tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No reports found</td>
            </tr>`;
		} else {
			for (let i = 0; i < data.length; i++) {
				const report = data[i];
				rows += `<tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${report.id}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${report.type}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${report.content}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${report.reporter}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${report.date}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <button onclick="deleteReport(${report.id})" class="text-red-600 hover:text-red-900">
                            <i class="fa-solid fa-ban"></i> Delete
                        </button>
                    </td>
                </tr>`;
			}
		}

		document.getElementById("reportsTableBody").innerHTML = rows;
	} catch (error) {
		console.error("Error loading reports:", error);
		document.getElementById("reportsTableBody").innerHTML = `
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-red-500">
                    Error loading reports. Please try again later.
                </td>
            </tr>`;
	}
}

// Function to delete a report
async function deleteReport(id) {
	if (confirm("Are you sure you want to delete this report?")) {
		try {
			const response = await fetch(`/admin/php/deletereport.php?id=${id}`);
			if (!response.ok) {
				throw new Error(`HTTP error! Status: ${response.status}`);
			}

			// Reload reports after successful deletion
			loadReports();

			// Show success message (optional)
			alert("Report deleted successfully!");
		} catch (error) {
			console.error("Error deleting report:", error);
			alert("Failed to delete report. Please try again.");
		}
	}
}

// Load reports when the page loads
document.addEventListener("DOMContentLoaded", function () {
	// Check if we're on the reports page
	if (document.getElementById("reportsTableBody")) {
		loadReports();
	}
});

// Function to generate report based on date filters
function generateReport() {
	// Get date values
	const fromDate = document.querySelector(
		'input[type="date"]:nth-of-type(1)'
	).value;
	const toDate = document.querySelector(
		'input[type="date"]:nth-of-type(2)'
	).value;

	// Validate dates
	if (!fromDate || !toDate) {
		alert("Please select both from and to dates");
		return;
	}

	// Here you would typically make an AJAX call with the date parameters
	// For now, we'll just reload the reports
	alert(`Generating report from ${fromDate} to ${toDate}`);
	loadReports();

	// Update stats (this would typically come from the server with filtered data)
	// This is just for demonstration
	document.getElementById("totalUsers").textContent =
		Math.floor(Math.random() * 300) + 200;
	document.getElementById("newPosts").textContent =
		Math.floor(Math.random() * 150) + 100;
	document.getElementById("userEngagement").textContent =
		Math.floor(Math.random() * 30) + 50 + "%";
	document.getElementById("totalInteractions").textContent =
		Math.floor(Math.random() * 10) / 10 + 1 + "k";
}
function homepage() {
	window.location.href = "../views/homepage.php";
}
function leaderboard() {
	window.location.href = "../views/leaderboard.php";
}
function users() {
	window.location.href = "../views/users.php";
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
