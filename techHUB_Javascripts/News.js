AOS.init();

const NEWS_API_KEY = "15f95de8-fc33-4246-94b3-54df06cdd20c";
const newsContainer = document.getElementById("news-container");
const newspost = document.querySelector(".newspost");
let page = 1;
let loading = false;

async function fetchNews(pageNum) {
	try {
		if (loading) return; // Prevent multiple simultaneous requests
		loading = true;

		// Show loading spinner on first load
		if (pageNum === 1) {
			newsContainer.innerHTML = `
                <div class="loading">
                    <i class="fas fa-spinner fa-spin"></i>
                    Loading news...
                </div>`;
		} else {
			// Add loading indicator at the bottom for subsequent loads
			const grid = document.querySelector(".news-grid");
			if (grid) {
				const loadingIndicator = document.createElement("div");
				loadingIndicator.className = "loading";
				loadingIndicator.innerHTML = `
                    <i class="fas fa-spinner fa-spin"></i>
                    Loading more news...`;
				grid.appendChild(loadingIndicator);
			}
		}

		const response = await fetch(
			`https://content.guardianapis.com/search?` +
				`api-key=${NEWS_API_KEY}` +
				`&show-fields=thumbnail,headline,bodyText,byline` +
				`&section=technology` +
				`&page=${pageNum}` +
				`&page-size=1`
		);

		if (!response.ok) {
			throw new Error("Network response was not ok");
		}

		const data = await response.json();
		console.log("API Response:", data); // Debug log

		// Remove any existing loading indicators
		const loadingIndicators = document.querySelectorAll(".loading");
		loadingIndicators.forEach((indicator) => indicator.remove());

		displayNews(data.response.results, pageNum === 1);
		loading = false;
	} catch (error) {
		console.error("Error fetching news:", error);
		if (pageNum === 1) {
			newsContainer.innerHTML = `
                <div class="error-message">
                    <p>Unable to load news at this time. Please try again later.</p>
                    <p>Error: ${error.message}</p>
                </div>`;
		}
		loading = false;
	}
}

function displayNews(articles, isFirstPage) {
	if (!articles || articles.length === 0) {
		newsContainer.innerHTML = "<p>No news articles available.</p>";
		return;
	}

	const newsHTML = articles
		.map(
			(article) => `
        <div class="news-card" data-aos="fade-up">
            ${
							article.fields?.thumbnail
								? `<div class="news-image">
                    <img src="${article.fields.thumbnail}" alt="${article.webTitle}">
                </div>`
								: '<div class="news-image-placeholder"></div>'
						}
            <div class="news-content">
                <h3 class="news-title">${article.webTitle}</h3>
                ${
									article.fields?.bodyText
										? `<p class="news-excerpt">${article.fields.bodyText.substring(
												0,
												100
										  )}...</p>`
										: ""
								}
                <div class="news-meta">
                    <span class="news-date">${timeAgo(
											new Date(article.webPublicationDate)
										)}</span>
                    <a href="${
											article.webUrl
										}" target="_blank" class="read-more">Read More</a>
                </div>
            </div>
        </div>
    `
		)
		.join("");

	const grid =
		document.querySelector(".news-grid") || document.createElement("div");
	if (isFirstPage) {
		grid.className = "news-grid";
		grid.innerHTML = newsHTML;
		newsContainer.innerHTML = "";
		newsContainer.appendChild(grid);
	} else {
		grid.insertAdjacentHTML("beforeend", newsHTML);
	}
}

function timeAgo(date) {
	const seconds = Math.floor((new Date() - date) / 1000);
	let interval = seconds / 31536000;

	if (interval > 1) return Math.floor(interval) + " years ago";
	interval = seconds / 2592000;
	if (interval > 1) return Math.floor(interval) + " months ago";
	interval = seconds / 86400;
	if (interval > 1) return Math.floor(interval) + " days ago";
	interval = seconds / 3600;
	if (interval > 1) return Math.floor(interval) + " hours ago";
	interval = seconds / 60;
	if (interval > 1) return Math.floor(interval) + " minutes ago";
	return Math.floor(seconds) + " seconds ago";
}

function handleScroll() {
	if (loading) return;

	const scrollPosition = newspost.scrollTop;
	const visibleHeight = newspost.clientHeight;
	const totalHeight = newspost.scrollHeight;

	// Load more when user is near the bottom (100px threshold)
	if (totalHeight - (scrollPosition + visibleHeight) < 100) {
		page++;
		fetchNews(page);
	}
}

// Search functionality
let search = document.querySelector("#searchbar");
let search3 = document.querySelector(".search3");
let divActive = document.querySelector(".divActive");

search.onkeyup = function (e) {
	e.preventDefault();

	let searchinputed = search.value;
	if (searchinputed !== "") {
		search3.classList.add("active");
	} else {
		search3.classList.remove("active");
		search3.innerHTML = "";
		divActive.style.display = "none";
	}

	let xhr1 = new XMLHttpRequest();
	xhr1.open("POST", "../newPhpfileTechhub/searchhome.php", true);
	xhr1.onload = function () {
		if (xhr1.readyState === XMLHttpRequest.DONE) {
			if (xhr1.status === 200) {
				let data = xhr1.response;
				search3.innerHTML = data;
			}
		}
	};
	xhr1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr1.send("searchterm=" + encodeURIComponent(searchinputed));
};

// Logout functionality
const logout = document.querySelector("#logout");
logout.onclick = function (e) {
	console.log("run");
	e.preventDefault();
	window.location.href = "../newPhpfileTechhub/logout.php";
};

// Report functionality
const showrepordiv = document.getElementById("showrepordiv");
showrepordiv.onclick = function (e) {
	e.preventDefault();
	document.getElementById("reportmessage").style.display = "block";
};

const closedivreport = document.getElementById("closedivreport");
closedivreport.onclick = function (e) {
	e.preventDefault();
	document.getElementById("reportmessage").style.display = "none";
};

// Initialize everything when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
	// Initial fetch
	fetchNews(1);

	// Add scroll listener
	newspost.addEventListener("scroll", handleScroll);

	// Feedback modal controls
	const feedbackModal = document.getElementById("feedbackModal");
	const closeFeedback = document.getElementById("closeFeedback");
	const feedbackDiv = document.getElementById("feedbackdiv");
	const feedbackForm = document.getElementById("feedbackForm");
	const starRating = document.getElementById("feedbackStars");
	const ratingText = document.getElementById("ratingText");
	const ratingInputs = starRating.querySelectorAll('input[type="radio"]');

	feedbackDiv.addEventListener("click", function (e) {
		e.preventDefault();
		feedbackModal.style.display = "block";
	});

	closeFeedback.addEventListener("click", function (e) {
		e.preventDefault();
		feedbackModal.style.display = "none";
	});

	ratingInputs.forEach((input) => {
		input.addEventListener("change", function () {
			starRating.classList.remove(
				"rate-1",
				"rate-2",
				"rate-3",
				"rate-4",
				"rate-5"
			);
			starRating.classList.add(`rate-${this.value}`);

			const ratingMessages = {
				1: "Poor - 1 Star",
				2: "Fair - 2 Stars",
				3: "Good - 3 Stars",
				4: "Very Good - 4 Stars",
				5: "Excellent - 5 Stars",
			};

			ratingText.textContent = ratingMessages[this.value];
		});
	});

	feedbackForm.addEventListener("submit", function (e) {
		e.preventDefault();
		const formData = new FormData(this);

		fetch("../newPhpfileTechhub/feedback.php", {
			method: "POST",
			body: formData,
		})
			.then((response) => response.text())
			.then((data) => {
				console.log("Server response:", data);

				if (data.includes("run")) {
					swal({
						title: "Success!",
						text: "Your feedback has been submitted.",
						icon: "success",
						button: "Close",
					}).then(() => {
						this.reset();
						feedbackModal.style.display = "none";
						ratingText.textContent = "No rating selected";
						starRating.classList.remove(
							"rate-1",
							"rate-2",
							"rate-3",
							"rate-4",
							"rate-5"
						);
					});
				} else {
					swal({
						title: "Error!",
						text: data || "Please fill all fields",
						icon: "error",
						button: "Close",
					});
				}
			})
			.catch((error) => {
				console.error("Error:", error);
				swal({
					title: "Error!",
					text: "Something went wrong. Please try again.",
					icon: "error",
					button: "Close",
				});
			});
	});
});
