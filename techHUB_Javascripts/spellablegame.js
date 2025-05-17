class WordQuizApp {
	constructor() {
		this.main = document.querySelector(".main");
		this.mainMenuView = document.querySelector(".main-menu-view");
		this.wordManagerBtn = document.querySelector(".word-manager");
		this.quizManagerBtn = document.querySelector(".quiz-manager");
		this.accountSettingsBtn = document.querySelector(".account-settings");
		this.logoutBtn = document.querySelector(".logout-btn");
		this.GameInput = document.querySelector(".game-input");
		this.flash_message = document.querySelector(".flash-message");
	}

	admin_init() {
		this.wordManagerBtn.addEventListener("click", () => {
			this.wordManagerBtn.classList.toggle("active");
			this.quizManagerBtn.classList.remove("active");
			this.accountSettingsBtn.classList.remove("active");
			this.renderWordManager();
		});
		this.quizManagerBtn.addEventListener("click", () => {
			this.quizManagerBtn.classList.toggle("active");
			this.wordManagerBtn.classList.remove("active");
			this.accountSettingsBtn.classList.remove("active");
			this.renderQuizManager();
		});
		this.accountSettingsBtn.addEventListener("click", () => {
			this.accountSettingsBtn.classList.toggle("active");
			this.wordManagerBtn.classList.remove("active");
			this.quizManagerBtn.classList.remove("active");
			this.renderAccountSettings();
		});
		this.logoutBtn.addEventListener("click", () => {
			this.alertModal("Are you sure you want to logout?", () => {
				window.location.replace("login_signup/logout.php");
			});
		});
		document.querySelector(".main").style.height = "100%";
		document.querySelector(".main-menu-view").style.backgroundColor = "#fff";
	}

	user_init() {
		document.body.style.flexDirection = "column";
		this.flash_message.style.top = "15vh";
		this.main.style.flexDirection = "column";
		this.main.style.justifyContent = "center";
		this.main.style.alignItems = "center";
		this.main.style.gap = "5%";
		this.userId;
		this.scoreMultiplier = 1000;
		this.userScore = 0;
		this.currentQuizWordCount = 0;

		this.renderUserMainPage();
		this.accountSettingsBtn.addEventListener("click", () => {
			const backBtn = this.createButton(
				"Back",
				this.renderUserMainPage.bind(this),
				["account-back-btn"]
			);

			this.clearAndAppend(this.main, [
				this.renderAccountSettings(this.main, backBtn),
			]);
		});
		this.logoutBtn.addEventListener("click", () => {
			this.alertModal("Are you sure you want to logout?", () => {
				window.location.replace("login_signup/logout.php");
			});
		});
	}

	renderUserMainPage() {
		console.log("hello");

		const systemNameDiv = this.createDiv("system-name-spellable");
		const systemName = this.createH("h1", "Spellable");
		const playBtn = this.createButton(
			"Play Game",
			this.renderGameQuizItems.bind(this, false),
			["card", "user-main-page-btn"]
		);
		const leaderboardBtn = this.createButton(
			"Leaderboards",
			this.renderLeaderboards.bind(this),
			["card", "user-main-page-btn"]
		);

		systemNameDiv.append(systemName);
		this.clearAndAppend(this.main, [systemNameDiv, playBtn, leaderboardBtn]);
	}

	// ========== Game Logic ==========

	async renderGameQuizItems(difficulty = false) {
		const titleDiv = this.createDiv("game-quizlist-title", "Choose a Quiz");
		const form = this.createForm("spellable-quizzes");

		const data = difficulty
			? await this.fetchData([
					["action", "get_quizzes"],
					["difficulty", difficulty],
			  ])
			: await this.fetchData([
					["action", "get_quizzes"],
					["difficulty", "All"],
			  ]);

		console.log(data);
		const sort = difficulty
			? this.createDifficultyDropdown(
					["All", "Easy", "Normal", "Hard"],
					difficulty,
					["game-quizlist-dropdown"]
			  )
			: this.createDifficultyDropdown(
					["All", "Easy", "Normal", "Hard"],
					false,
					["game-quizlist-dropdown"]
			  );
		sort.addEventListener("change", (e) => {
			const difficulty = String(e.target.value);
			console.log(difficulty);
			this.renderGameQuizItems(difficulty);
		});

		const backBtn = this.createButton(
			"Main Menu",
			this.renderUserMainPage.bind(this),
			["btn-edit"]
		);

		if (data.quizzes && data.quizzes.length > 0) {
			data.quizzes.forEach((quiz) => {
				const quizDiv = this.createDiv(["game-quiz", "card"]);
				quizDiv.textContent = quiz.name;
				Object.assign(quizDiv.dataset, quiz);
				form.append(quizDiv);
			});
		} else {
			form.textContent = difficulty
				? `No ${difficulty} quizzes found`
				: "No quizzes found";
			form.style.justifyContent = "center";
			form.style.alignItems = "center";
		}

		this.clearAndAppend(this.main, [titleDiv, sort, form, backBtn]);

		this.gameAttachListeners(".game-quiz", "click");
	}

	async renderGame(quizId) {
		this.isGameInputSubmittable = true;
		this.isInputEmpty = true;

		const form = new FormData();
		form.append("action", "get_quiz_words");
		form.append("quiz_id", quizId);
		this.quizdata = await this.POST(form);
		this.currentQuizId = quizId;
		this.currentQuizWordDefinition =
			this.quizdata.quiz_words[this.currentQuizWordCount].definition;
		this.wordDefinitionContainer = this.createDiv(
			"word-definition-container",
			this.currentQuizWordDefinition
		);
		this.GameInput = this.createInput("quiz-current-word", "Enter Word", true);
		const gameTip = this.createDiv("game-tip", "Press Enter to Submit");
		this.speaker = this.createSpeaker();

		const exitbtn = this.createButton(
			"Exit",
			() => {
				this.alertModal("Are you sure you want to exit the quiz?", () => {
					this.currentQuizWordCount = 0;
					clearInterval(this.gameInterval);
					clearInterval(this.gameTimeInterval);
					this.renderUserMainPage();
				});
			},
			["btn-delete"]
		);

		console.log(this.quizdata.quiz_words);
		this.currentQuizWord =
			this.quizdata.quiz_words[this.currentQuizWordCount].name;

		this.timePassed();
		this.clearAndAppend(this.main, [
			this.wordDefinitionContainer,
			this.append(this.createDiv("game-input-container"), [
				this.GameInput,
				gameTip,
			]),
			this.speaker,
			exitbtn,
		]);
		this.speak(this.currentQuizWord);
		this.gameInputSubmit(this.isWordInputCorrect.bind(this));
		this.speaker.addEventListener("click", () =>
			this.speak(this.currentQuizWord)
		);

		this.GameInput.addEventListener("keydown", function (e) {
			if (
				[8, 9, 13, 27, 46, 37, 38, 39, 40].indexOf(e.keyCode) !== -1 ||
				((e.ctrlKey || e.metaKey) &&
					["A", "C", "V", "X"].includes(e.key.toUpperCase()))
			) {
				return;
			}
			if (!/^[a-zA-Z]$/.test(e.key)) {
				e.preventDefault();
			}
		});

		this.GameInput.addEventListener("input", (e) => {
			this.GameInput.value = this.GameInput.value.replace(/[^a-zA-Z]/g, "");

			console.log(
				"isinputempty",
				this.isInputEmpty,
				"value",
				this.GameInput.value
			);

			if (this.isInputEmpty && this.GameInput.value !== "") {
				this.isInputEmpty = false;
				gameTip.classList.toggle("active");

				return;
			}

			if (this.GameInput.value === "") {
				this.isInputEmpty = true;
				gameTip.classList.toggle("active");
			}
		});
	}

	timePassed() {
		this.seconds = 0;
		this.gameTimeInterval = setInterval(() => {
			this.seconds += 1;
		}, 1000);
		this.gameInterval = setInterval(() => {
			this.seconds += 5;
			this.quizScore();
		}, 5000);
	}

	quizScore() {
		const wordsCount = this.quizdata.quiz_words.length;
		this.userScore =
			this.scoreMultiplier * wordsCount - this.seconds * wordsCount;
		this.userScore =
			this.userScore <= 500
				? (this.userScore = 500)
				: (this.userScore =
						this.scoreMultiplier * wordsCount - this.seconds * wordsCount);
		console.log(this.userScore);
	}

	async submitScore(userId) {
		const currentUserId = userId;
		console.log(userId);
		const userScore = this.userScore;
		const timePassed = this.seconds;
		const response = await this.fetchData([
			["action", "submit_score"],
			["user_id", currentUserId],
			["score", userScore],
			["time_passed", timePassed],
			["quiz_id", this.currentQuizId],
		]);

		console.log(response);

		this.renderScoreModal(userScore, timePassed, currentUserId);
	}

	async renderScoreModal(userScore, timePassed, userId) {
		const overlay = this.createDiv("overlay");
		const modal = this.createDiv("modal");
		const btnContainer = this.createDiv("btn-container");
		const menuBtn = this.createButton(
			"Menu",
			this.renderUserMainPage.bind(this)
		);
		const leaderboardBtn = this.createButton(
			"Leaderboards",
			this.renderLeaderboards.bind(this)
		);
		const highScore = await this.fetchData([
			["action", "get_highscore"],
			["quiz_id", this.currentQuizId],
			["user_id", userId],
		]);

		this.append(btnContainer, [menuBtn, leaderboardBtn]);

		this.append(modal, [
			this.createH("h2", `Quiz Result`),
			this.createH("h3", `Time Passed: ${timePassed}`),
			this.createH("h3", `Score: ${userScore}`),
			this.createH("h3", `High Score: ${highScore.high_score.score}`),
			btnContainer,
		]);

		this.append(overlay, [modal]);
		this.append(this.main, [overlay]);
	}

	async renderLeaderboards() {
		const quizzes = await this.fetchData([
			["action", "get_quizzes"],
			["difficulty", "All"],
		]);

		console.log(quizzes);
		const leaderboardDiv = this.createDiv("leaderboard-quiz-list");
		if (quizzes.quizzes) {
			quizzes.quizzes.forEach((item) => {
				const leaderboardItem = this.createDiv([
					"leaderboard-quiz-item",
					"card",
				]);
				leaderboardItem.textContent = `${item.name}`;
				leaderboardDiv.append(leaderboardItem);
				leaderboardItem.addEventListener("click", () =>
					this.renderLeaderboardQuiz(item.id)
				);
			});
		} else {
			console.log("no quizzes");
			leaderboardDiv.textContent = "No quizzes found";
			leaderboardDiv.style.justifyContent = "center";
		}

		this.clearAndAppend(this.main, [
			this.createH("h1", "Select Quiz", ["leaderboard-title"]),
			leaderboardDiv,
			this.createButton("Back", this.renderUserMainPage.bind(this), [
				"btn-edit",
			]),
		]);
	}

	async renderLeaderboardQuiz(quizId) {
		const data = await this.fetchData([
			["action", "get_leaderboards"],
			["quiz_id", quizId],
		]);

		console.log(data);

		const leaderboard = this.createDiv("leaderboard");
		const leaderboardTitle = this.append(
			this.createDiv("leaderboard-category"),
			[
				this.createDiv("leaderboard-item-name", "Player Name"),
				this.createDiv("leaderboard-item-score", "Score"),
				this.createDiv("leaderboard-item-time-passed", "Time Passed"),
			]
		);
		const leaderboardItems = this.createDiv("leaderboard-items");

		this.append(leaderboard, [leaderboardTitle, leaderboardItems]);

		if (data.leaderboards && data.leaderboards.length > 0) {
			data.leaderboards.forEach((item) => {
				this.append(leaderboardItems, [
					this.append(this.createDiv("leaderboard-item"), [
						this.createDiv(
							"leaderboard-item-name",
							`${item.fname} ${item.lname}`
						),
						this.createDiv("leaderboard-item-score", `${item.score}`),
						this.createDiv(
							"leaderboard-item-time-passed",
							`${item.time_passed}s`
						),
					]),
				]);
			});
		} else {
			console.log("no leaderboards");
			leaderboardItems.textContent = "Leaderboard is empty";
			leaderboardItems.style.justifyContent = "center";
		}

		this.clearAndAppend(this.main, [
			this.createH("h1", "Leaderboard", ["leaderboard-title"]),
			leaderboard,
			this.createButton("Back", this.renderLeaderboards.bind(this), [
				"btn-edit",
			]),
		]);
	}

	gameInputSubmit(callback) {
		this.GameInput.addEventListener("keydown", (e) => {
			if (e.key === "Enter" && this.isGameInputSubmittable) {
				this.isGameInputSubmittable = false;
				setTimeout(() => {
					this.isGameInputSubmittable = true;
				}, 1000);
				const result = callback(this.GameInput.value, this.currentQuizWord);
				if (result) this.nextWord(this.quizdata.quiz_words);
			}
		});
	}

	showAnswerFeedback(isCorrect) {
		// Remove any existing feedback class
		this.GameInput.classList.remove("input-correct", "input-wrong");

		// Add the appropriate class
		if (isCorrect) {
			this.GameInput.classList.add("input-correct");
		} else {
			this.GameInput.classList.add("input-wrong");
		}

		// Remove the class after 1 second
		setTimeout(() => {
			this.GameInput.classList.remove("input-correct", "input-wrong");
		}, 1000);
	}

	isWordInputCorrect(wordInput, currentQuizWord) {
		const isCorrect =
			wordInput.trim().toLowerCase() === currentQuizWord.trim().toLowerCase();
		this.showAnswerFeedback(isCorrect);

		if (isCorrect) {
			setTimeout(() => {
				// Remove feedback and go to next word
				let feedback = document.querySelector(".answer-feedback");
				if (feedback) feedback.remove();
				this.nextWord(this.quizdata.quiz_words);
			}, 1000); // 1 second delay for user to see feedback
		}
	}

	nextWord(quizWords) {
		document.querySelector(".game-tip").classList.toggle("active");
		this.isInputEmpty = true;
		if (this.currentQuizWordCount !== quizWords.length - 1) {
			console.log("correct");
			// this.renderGame(quizWords[this.currentQuizWordCount].id)
			this.currentQuizWordCount++;

			this.currentQuizWord =
				this.quizdata.quiz_words[this.currentQuizWordCount].name;
			this.speak(this.currentQuizWord);
			this.currentQuizWordDefinition =
				this.quizdata.quiz_words[this.currentQuizWordCount].definition;
			this.wordDefinitionContainer.textContent = this.currentQuizWordDefinition;
			this.GameInput.value = "";

			console.log(this.currentQuizWordCount, this.currentQuizWord);
			return;
		}

		console.log("corrects");
		clearInterval(this.gameInterval);
		clearInterval(this.gameTimeInterval);
		this.submitScore(this.userId);
		this.currentQuizWordCount = 0;
	}

	// ========== Word Manager ==========
	renderWordManager() {
		this.mainMenuView.innerHTML = "";
		const addWordBtn = this.createDiv(
			["add-word", "manager-div", "btn"],
			"Add Word"
		);
		const wordListBtn = this.createDiv(
			["word-list", "manager-div", "btn"],
			"Word List"
		);

		addWordBtn.addEventListener("click", () => this.renderAddWordForm());
		wordListBtn.addEventListener("click", (e) => this.renderWordList(e));

		this.mainMenuView.append(addWordBtn, wordListBtn);
	}

	renderAddWordForm() {
		this.mainMenuView.innerHTML = "";
		const addForm = this.createForm("add-form");
		const wordInput = this.createInput("name", "Enter Word", true);
		const btnContainer = this.createDiv("btn-container-add");
		const addBtn = this.createSubmitInput("Add Word", ["btn"]);
		const cancelBtn = this.createButton(
			"Cancel",
			() => this.renderWordManager(),
			["btn-delete"]
		);

		this.append(btnContainer, [addBtn, cancelBtn]);

		this.clearAndAppend(addForm, [
			this.createH("h3", "Word Manager"),
			this.createHiddenInput("add_word"),
			wordInput,
			this.createTextarea("definition", "Word Definition", true),
			btnContainer,
		]);

		wordInput.addEventListener("input", () => this.alphabetOnly(wordInput));

		this.append(btnContainer, [addBtn, cancelBtn]);

		this.clearAndAppend(this.mainMenuView, [addForm]);

		addForm.addEventListener("submit", async (e) => {
			const data = await this.POST(e, addForm);
			if (data.status === "success") this.flashMessage(data.message);
			this.renderAddWordForm();
		});
	}

	async renderWordList(e) {
		e?.preventDefault();
		let isCheckboxSelected = false;

		const data = await this.getWords();
		const wordsForm = this.createForm([
			"words-container",
			"words-form",
			"list-form",
		]);
		const btnContainer = this.createDiv("delete-btn-container");
		const deleteBtn = this.createDiv(["btn-delete", "delete"], "Delete");
		const deleteAllBtn = this.createDiv(["btn-delete", "delete"], "Delete All");

		deleteBtn.addEventListener("click", async (e) => {
			if (!isCheckboxSelected) return this.flashMessage("No selected Items!");
			this.alertModal(
				"Are you sure you want to delete the selected words?",
				async () => {
					const data = await this.POST(e, wordsForm);
					this.flashMessage(data.message);
					this.renderWordList();
				},
				["btn-delete"]
			);
		});

		deleteAllBtn.addEventListener("click", async (e) => {
			this.alertModal(
				"Are you sure you want to delete all words?",
				async () => {
					const data = await this.deleteAll(e, "deleteAll_words");
					this.flashMessage(data.message);
					this.renderWordList();
				},
				["btn-delete"]
			);
		});

		this.clearAndAppend(btnContainer, [deleteBtn, deleteAllBtn]);

		this.clearAndAppend(wordsForm, [this.createHiddenInput("delete_word")]);

		if (data.words) {
			data.words.forEach((word) => {
				const wordDiv = this.createDiv("word-manager-word");
				Object.assign(wordDiv.dataset, word);

				const nameDiv = this.createDiv(["card"]);
				nameDiv.innerHTML = `
          <div class="card-content">
            <div class="card-title">${word.name}</div>
          </div>
        `;
				wordDiv.append(nameDiv);

				const checkbox = this.createCheckbox(word.id);
				checkbox.addEventListener("click", () => {
					isCheckboxSelected = this.hasCheckboxSelected();
				});

				const checkboxContainer = this.createDiv("word-checkbox-container");
				checkboxContainer.append(checkbox);
				wordDiv.append(checkboxContainer);

				const editDiv = this.createDiv(["word-edit", "btn-edit"], "Edit");
				Object.assign(editDiv.dataset, word);
				wordDiv.append(editDiv);

				this.append(wordsForm, [wordDiv]);
			});

			this.mainMenuView.append(wordsForm);
			this.clearAndAppend(this.mainMenuView, [
				btnContainer,
				wordsForm,
				this.createButton("Back", () => this.renderWordManager(), ["btn-edit"]),
			]);
			this.attachEditListeners(
				".word-edit",
				"edit_word",
				this.renderWordEditForm.bind(this)
			);
		} else {
			wordsForm.textContent = "No words found.";
			wordsForm.style.justifyContent = "center";
			this.clearAndAppend(this.mainMenuView, [
				btnContainer,
				wordsForm,
				this.createButton("Back", () => this.renderWordManager()),
			]);
		}
	}

	renderWordEditForm(wordDiv, actionValue) {
		const overlay = this.createDiv("sub-main-menu-view");
		const form = this.createForm("edit-form-word");
		const buttonContainer = this.createDiv("btn-container-edit");
		const updateBtn = this.createSubmitInput("Update", ["btn"]);
		const cancelBtn = this.createButton("Cancel", () => overlay.remove(), [
			"btn-delete",
		]);

		this.append(form, [
			this.createHiddenInput(actionValue),
			this.createHiddenInput(null, "name", wordDiv.dataset.name),
			this.createH("h3", wordDiv.dataset.name),
			this.createTextarea("definition", "", true, wordDiv.dataset.definition),
			buttonContainer,
		]);

		this.append(overlay, [form]);

		this.append(this.main, [overlay]);

		this.append(buttonContainer, [updateBtn, cancelBtn]);
		overlay.addEventListener("click", (e) => {
			if (!form.contains(e.target)) overlay.remove();
		});

		// cancelBtn.addEventListener("click", () => overlay.remove());

		form.addEventListener("submit", async (e) => {
			const data = await this.POST(e, form);
			if (data.status === "success") this.flashMessage(data.message);
			this.renderWordList();
			overlay.remove();
		});
	}

	// ========== Quiz Manager ==========
	renderQuizManager() {
		const addQuiz = this.createDiv(
			["add-quiz", "manager-div", "btn"],
			"Add Quiz"
		);
		const quizList = this.createDiv(
			["quiz-list", "manager-div", "btn"],
			"Quiz List"
		);

		addQuiz.addEventListener("click", () => this.renderAddQuizForm());
		quizList.addEventListener("click", () => this.renderQuizList());

		this.clearAndAppend(this.mainMenuView, [addQuiz, quizList]);
	}

	async renderAddQuizForm() {
		const form = this.createForm("add-form");
		const data = await this.getWords();
		const wordsDivContainer = this.createDiv("words-div-container");
		const createQuizInput = this.createInput("name", "Quiz name", true);
		const createQuizDefinition = this.createTextarea(
			"definition",
			"Quiz Definition",
			true
		);

		this.append(wordsDivContainer, [
			this.createH("h3", "Select Words to be added to the quiz"),
			this.createDiv("words-div"),
			this.append(this.createDiv("btn-container-add"), [
				this.createSubmitInput("Create Quiz", ["btn"]),
				this.createButton(
					"Back",
					() => {
						wordsDivContainer.classList.toggle("active");
						document
							.querySelectorAll(".btn, .btn-delete, .btn-edit")
							.forEach((btn) => {
								btn.style.pointerEvents = "none";
							});

						setTimeout(() => {
							document
								.querySelectorAll(".btn, .btn-delete, .btn-edit")
								.forEach((btn) => {
									btn.style.pointerEvents = "auto";
								});
						}, 500);
					},
					["btn-edit"]
				),
			]),
		]);

		this.append(form, [
			this.createHiddenInput("add_quiz"),
			createQuizInput,
			this.createDifficultyDropdown(["Easy", "Normal", "Hard"], false, [
				"quiz-manager-dropdown",
			]),
			createQuizDefinition,
			wordsDivContainer,
			this.append(this.createDiv("btn-container-add"), [
				this.createButton(
					"Next",
					() => {
						if (
							createQuizInput.value !== "" &&
							createQuizDefinition.value !== ""
						) {
							wordsDivContainer.classList.toggle("active");
							document
								.querySelectorAll(".btn, .btn-delete, .btn-edit")
								.forEach((btn) => {
									btn.style.pointerEvents = "none";
								});
							setTimeout(() => {
								document
									.querySelectorAll(".btn, .btn-delete, .btn-edit")
									.forEach((btn) => {
										btn.style.pointerEvents = "auto";
									});
							}, 500);
							return;
						}

						this.flashMessage("Please fill up the Quiz name and definition");
					},
					["btn"]
				),
				this.createButton("Cancel", () => this.renderQuizManager(), [
					"btn-delete",
				]),
			]),
		]);

		this.clearAndAppend(this.mainMenuView, [form]);

		form.addEventListener("submit", async (e) => {
			const data = await this.POST(e, form);
			this.flashMessage(data.message);
			if (data.status === "success") this.renderQuizManager();
		});

		if (data.words) {
			data.words.forEach((word) => {
				const wordsDiv = form.querySelector(".words-div");
				const wordDiv = this.createDiv("quiz-manager-word");
				wordDiv.innerHTML = `
          <div class="card">
            <div class="card-content">
              <div class="word-name">${word.name}</div>
            </div>
          </div>
          <div class="word-checkbox-container">
            <input type="checkbox" class="word-checkbox" name="checkbox[]" value="${word.id}" />
          </div>
        `;
				wordsDiv.append(wordDiv);
				return wordsDiv;
			});

			return;
		}

		document.querySelector(".words-div").textContent = data.message;
	}

	async renderQuizList() {
		let isCheckboxSelected = false;

		const data = await this.fetchData([
			["action", "get_quizzes"],
			["difficulty", "All"],
		]);
		const quizzes_form = this.createForm([
			"quizzes-container",
			"quizzes-form",
			"list-form",
		]);
		const btn_container = this.createDiv("delete-btn-container");
		const delete_btn = this.createDiv(["btn-delete", "delete"], "Delete");
		const deleteAll_btn = this.createDiv(
			["btn-delete", "delete"],
			"Delete All"
		);
		const action_input = this.createHiddenInput("delete_quiz");
		const backBtn = this.createButton("Back", () => this.renderQuizManager(), [
			"btn-edit",
		]);

		quizzes_form.append(action_input);

		if (data.quizzes) {
			data.quizzes.forEach((quiz) => {
				const quizDiv = this.createDiv("quiz-manager-quiz");

				const nameDiv = this.createDiv(["quiz-name", "card"]);
				nameDiv.innerHTML = `
          <div class="card-content">
            <div class="card-title">${quiz.name}</div>
          </div>
        `;
				quizDiv.append(nameDiv);

				const checkbox = this.createCheckbox(quiz.id);
				checkbox.addEventListener("click", () => {
					isCheckboxSelected = this.hasCheckboxSelected();
				});

				const checkboxContainer = this.createDiv("quiz-checkbox-container");
				checkboxContainer.append(checkbox);
				quizDiv.append(checkboxContainer);

				const editDiv = this.createDiv(["quiz-edit", "btn-edit"], "Edit");
				Object.assign(editDiv.dataset, quiz);
				quizDiv.append(editDiv);

				quizzes_form.append(quizDiv);
			});
		} else {
			quizzes_form.textContent = "No quizzes found.";
			quizzes_form.style.justifyContent = "center";
		}

		delete_btn.addEventListener("click", async (e) => {
			if (!isCheckboxSelected) return this.flashMessage("No selected Items!");
			this.alertModal(
				"Are you sure you want to delete the selected quizzes?",
				async () => {
					const data = await this.POST(e, quizzes_form);
					this.flashMessage(data.message);
					this.renderQuizList();
				},
				["btn-delete"]
			);
		});

		deleteAll_btn.addEventListener("click", async (e) => {
			this.alertModal(
				"Are you sure you want to delete all quizzes?",
				async () => {
					const data = await this.deleteAll(e, "deleteAll_quizzes");
					this.flashMessage(data.message);
					this.renderQuizList();
				},
				["btn-delete"]
			);
		});

		this.append(btn_container, [delete_btn, deleteAll_btn]);

		this.clearAndAppend(this.mainMenuView, [
			btn_container,
			quizzes_form,
			backBtn,
		]);

		this.attachEditListeners(
			".quiz-edit",
			"edit_quiz",
			this.renderQuizEditForm.bind(this)
		);
	}

	async renderQuizEditForm(wordDiv, actionValue) {
		const form = this.createForm(["edit-form", "edit-form-quiz"]);
		const data = await this.fetchData([
			["action", "get_quiz_words"],
			["quiz_id", wordDiv.dataset.id],
		]);
		const overlay = this.createDiv("sub-main-menu-view");
		const editQuizInput = this.createInput(
			"name",
			"Quiz name",
			true,
			wordDiv.dataset.name
		);
		const editQuizDefinition = this.createTextarea(
			"definition",
			"Quiz Definition",
			true,
			wordDiv.dataset.definition
		);
		const wordsDivContainer = this.createDiv("words-div-container");
		const cancelBtn = this.createButton("Cancel", () => overlay.remove(), [
			"btn-delete",
		]);

		console.log("haha", data);

		this.main.append(overlay);

		overlay.append(form);
		overlay.addEventListener("click", (e) => {
			if (!form.contains(e.target)) overlay.remove();
		});

		// console.log(wordDiv.dataset.definition)
		this.append(wordsDivContainer, [
			this.createH("h3", "Select Words to be added to the quiz"),
			this.createDiv("words-div"),
			this.append(this.createDiv("btn-container-edit"), [
				this.createSubmitInput("Update", ["btn"]),
				this.createButton(
					"Back",
					() => {
						wordsDivContainer.classList.toggle("active");
						document
							.querySelectorAll(".btn, .btn-delete, .btn-edit")
							.forEach((btn) => {
								btn.style.pointerEvents = "none";
							});

						setTimeout(() => {
							document
								.querySelectorAll(".btn, .btn-delete, .btn-edit")
								.forEach((btn) => {
									btn.style.pointerEvents = "auto";
								});
						}, 500);
					},
					["btn-edit"]
				),
			]),
		]),
			form.append(
				this.createHiddenInput(actionValue),
				this.createHiddenInput(wordDiv.dataset.id, "quiz_id"),
				editQuizInput,
				this.createDifficultyDropdown(
					["Easy", "Normal", "Hard"],
					wordDiv.dataset.difficulty,
					["quiz-manager-dropdown"]
				),
				editQuizDefinition,
				wordsDivContainer,
				this.append(this.createDiv("btn-container-edit"), [
					this.createButton(
						"Next",
						() => {
							if (
								editQuizInput.value !== "" &&
								editQuizDefinition.value !== ""
							) {
								wordsDivContainer.classList.toggle("active");
								document
									.querySelectorAll(".btn, .btn-delete, .btn-edit")
									.forEach((btn) => {
										btn.style.pointerEvents = "none";
									});
								setTimeout(() => {
									document
										.querySelectorAll(".btn, .btn-delete, .btn-edit")
										.forEach((btn) => {
											btn.style.pointerEvents = "auto";
										});
								}, 500);
								return;
							}

							this.flashMessage("Please fill up the Quiz name and definition");
						},
						["btn"]
					),
					cancelBtn,
				])
			);

		const wordsDiv = form.querySelector(".words-div");
		console.log(data.quiz_words);
		data.quiz_words.forEach((word) => {
			const isChecked = word.quiz_id ? "checked" : "";

			wordsDiv.innerHTML += `
        <div class="quiz-manager-word">
          <div class="card">
            <div class="card-content">
              <div class="word-name">${word.name}</div>
            </div>
          </div>
          <div class="word-checkbox-container">
            <input type="checkbox" class="word-checkbox" name="checkbox[]" value="${word.word_id}" ${isChecked} />
          </div>
        </div>
      `;
		});

		this.attachEditListeners(
			".word-edit",
			"edit_word",
			this.renderWordEditForm.bind(this)
		);

		form.addEventListener("submit", async (e) => {
			const data = await this.POST(e, form);
			if (data.status === "success") this.renderQuizList();
			this.flashMessage(data.message);
			overlay.remove();
		});
	}
	// ========== Account Settings ==========

	async renderAccountSettings(parent = this.mainMenuView, backBtn = false) {
		const account_form = this.createForm(["account-form", "form"]);
		const data = await this.getCurrentUser();
		console.log(data);

		// account_form.setAttribute("enctype", "multipart/form-data");

		account_form.append(
			this.createHiddenInput("edit_account"),
			this.createInput("fname", "First name", true, data.fname),
			this.createInput("mname", "Middle name", true, data.mname),
			this.createInput("lname", "Last name", true, data.lname),
			this.createEmailInput("email", "Email", true, data.email),
			this.createInput("username", "Username", true, data.username),
			this.createPasswordInput(
				"new_password",
				"New password (Leave blank if don't want to change)",
				false
			),
			this.createPasswordInput(
				"confirm_new_password",
				"Confirm new password (Leave blank if don't want to change)",
				false
			),
			this.createPasswordInput(
				"old_password",
				"Enter old password to confirm",
				true
			),
			this.createSubmitInput("Update Account", "account-update-btn")
		);

		if (backBtn) account_form.append(backBtn);

		account_form.addEventListener("submit", async (e) => {
			const data = await this.POST(e, account_form);
			console.log(data);
			this.flashMessage(data.message);
			if (data.status === "success") this.renderUserMainPage();
		});

		this.clearAndAppend(parent, [account_form]);
	}

	// ========== Helpers ==========
	createDiv(className, text) {
		const div = document.createElement("div");
		if (Array.isArray(className)) div.classList.add(...className);
		else if (className) div.classList.add(className);
		if (text) div.textContent = text;
		return div;
	}

	createForm(className) {
		const form = document.createElement("form");
		if (className) {
			if (Array.isArray(className)) form.classList.add(...className);
			else form.classList.add(className);
		}
		form.action = "";
		return form;
	}

	createInput(name, placeholder, required = false, value = false) {
		const input = document.createElement("input");
		input.name = name;
		input.type = "text";
		input.classList.add(name.replace("_", "-"));
		input.placeholder = placeholder ? placeholder : "Name";
		input.required = required;
		input.value = value ? value : "";
		return input;
	}

	createEmailInput(name, placeholder, required = false, value = false) {
		const input = document.createElement("input");
		input.type = "email";
		input.name = name;
		input.placeholder = placeholder ? placeholder : "Name";
		input.required = required;
		input.value = value ? value : "";
		return input;
	}

	createPasswordInput(name, placeholder, required = false) {
		const input = document.createElement("input");
		input.type = "password";
		input.name = name;
		input.placeholder = placeholder ? placeholder : "Name";
		input.required = required;
		return input;
	}

	createTextarea(name, placeholder, required = false, value = "") {
		const textarea = document.createElement("textarea");
		textarea.name = name;
		textarea.placeholder = placeholder;
		textarea.required = required;
		textarea.value = value;
		return textarea;
	}

	createSubmitInput(value, className = []) {
		const input = document.createElement("input");
		input.type = "submit";
		input.value = value;
		if (className) input.classList.add(...className);
		return input;
	}

	createHiddenInput(value, name = "action", actualValue = null) {
		const input = document.createElement("input");
		input.type = "hidden";
		input.name = name;
		input.value = actualValue !== null ? actualValue : value;
		return input;
	}

	createButton(text, onClick, className = []) {
		const button = document.createElement("button");
		button.type = "button";
		button.textContent = text;
		button.addEventListener("click", onClick);
		if (className) button.classList.add(...className);
		return button;
	}

	createCheckbox(value) {
		const checkbox = document.createElement("input");
		checkbox.type = "checkbox";
		checkbox.name = "checkbox[]";
		checkbox.value = value;
		checkbox.classList.add("word-checkbox");
		return checkbox;
	}

	createH(hType, textcontent = false, className = []) {
		const h = document.createElement(hType);
		h.textContent = textcontent ? textcontent : "";
		if (className) h.classList.add(...className);

		return h;
	}

	createDifficultyDropdown(options, selectedValue, className = []) {
		const select = document.createElement("select");
		select.name = "difficulty";
		select.required = true;
		if (className) select.classList.add(...className);

		options.forEach((level) => {
			const option = document.createElement("option");
			option.value = level;
			option.textContent = level;
			select.append(option);
		});

		select.value = selectedValue ? selectedValue : options[0];

		return select;
	}

	async deleteAll(e, deleteAction) {
		const form = new FormData();
		form.append("action", deleteAction);

		const response = await fetch("http://192.168.1.12/spellable/routes.php", {
			method: "POST",
			body: form,
		});
		return response.json();
	}

	async fetchData(action) {
		const formData = new FormData();

		action.forEach((hiddenInput) => {
			formData.append(hiddenInput[0], hiddenInput[1]);
		});

		const response = await fetch("http://192.168.1.12/spellable/routes.php", {
			method: "POST",
			body: formData,
		});

		return await response.json();
	}

	async getWords() {
		const formData = new FormData();
		formData.append("action", "get_words");

		const response = await fetch("http://192.168.1.12/spellable/routes.php", {
			method: "POST",
			body: formData,
		});

		return await response.json();
	}

	async getQuizzes() {
		const formData = new FormData();
		formData.append("action", "get_quizzes");

		const response = await fetch("http://192.168.1.12/spellable/routes.php", {
			method: "POST",
			body: formData,
		});

		return await response.json();
	}

	async getQuiz(quizId) {
		const formData = new FormData();
		formData.append("action", "get_quiz_words");
		form.append("quiz_id", quizId);

		const response = await fetch("http://192.168.1.12/spellable/routes.php", {
			method: "POST",
			body: formData,
		});

		return await response.json();
	}

	async getCurrentUser() {
		const formData = new FormData();
		formData.append("action", "current_user");

		const response = await fetch("../integ/post.php", {
			method: "POST",
			body: formData,
		});

		return await response.json();
	}

	clearAndAppend(parent, elements) {
		parent.innerHTML = "";

		elements.forEach((element) => {
			parent.append(element);
		});

		return parent;
	}

	append(parent, elements) {
		elements.forEach((element) => {
			parent.append(element);
		});

		return parent;
	}

	async POST(e, form) {
		let formData;

		// If the first argument is a FormData instance
		if (e instanceof FormData) {
			formData = e;

			// If the first argument is an Event (from submit), and second is a form element
		} else if (e instanceof Event && form instanceof HTMLFormElement) {
			e.preventDefault();
			formData = new FormData(form);

			// If only a form element is passed (like: POST(form))
		} else if (e instanceof HTMLFormElement) {
			formData = new FormData(e);
		} else {
			throw new Error("Invalid arguments passed to POST()");
		}

		const response = await fetch("http://192.168.1.12/spellable/routes.php", {
			method: "POST",
			body: formData,
		});

		return await response.json();
	}

	hasCheckboxSelected() {
		return (
			document.querySelectorAll('input[name="checkbox[]"]:checked').length > 0
		);
	}

	alphabetOnly(input) {
		input.value = input.value.replace(/[^a-zA-Z]/g, "");
	}

	flashMessage(message) {
		const flashMessage = document.querySelector(".flash-message");
		flashMessage.textContent = message;
		flashMessage.classList.toggle("active");
		setTimeout(() => {
			flashMessage.classList.toggle("active");
		}, 3000);
	}

	attachEditListeners(selector, actionValue, editFormFunction) {
		document.querySelectorAll(selector).forEach((div) => {
			console.log(div);
			div.addEventListener("click", (e) => {
				const wordDiv = e.currentTarget;
				console.log(wordDiv);
				editFormFunction(wordDiv, actionValue);
			});
		});
	}

	gameAttachListeners(
		selector,
		eventlistener,
		startGameFunction = this.renderGame.bind(this)
	) {
		document.querySelectorAll(selector).forEach((div) => {
			div.addEventListener(eventlistener, (e) => {
				const wordDiv = e.currentTarget;
				startGameFunction(wordDiv.dataset.id);
			});
		});
	}

	alertModal(message, onConfirm) {
		// Create overlay and modal
		const overlay = this.createDiv("overlay");
		const modalForm = this.createDiv("modal");
		const msgDiv = document.createElement("div");
		msgDiv.textContent = message;
		msgDiv.style.marginBottom = "20px";
		const btnContainer = document.createElement("div");
		btnContainer.style.display = "flex";
		btnContainer.style.justifyContent = "center";
		btnContainer.style.gap = "10px";
		const confirmBtn = this.createDiv(["btn"], "Yes");
		const cancelBtn = this.createDiv(["btn-delete"], "No");

		// Button actions
		confirmBtn.addEventListener("click", () => {
			if (onConfirm) onConfirm();
			overlay.remove();
		});
		cancelBtn.addEventListener("click", () => {
			overlay.remove();
		});

		// Build modal
		btnContainer.append(confirmBtn, cancelBtn);
		modalForm.append(msgDiv, btnContainer);
		overlay.append(modalForm);
		document.body.appendChild(overlay);
	}

	// ========== API ==========

	async speak(currentQuizWord) {
		if (!navigator.onLine) {
			const text = currentQuizWord;
			const speech = new SpeechSynthesisUtterance(text);
			speech.lang = "en-US"; // You can change to any language like "ja-JP", "fr-FR", etc.
			window.speechSynthesis.speak(speech);
			return;
		}

		const apiKey = "sk_a7d1db41fe590fb45b5e4af54087a372e9ab505a437d3540"; // 👈 Replace with your ElevenLabs API key
		const voiceId = "Xb7hH8MSUJpSbSDYk0k2"; // voice ID (Alice)
		const text = currentQuizWord;

		const response = await fetch(
			`https://api.elevenlabs.io/v1/text-to-speech/${voiceId}`,
			{
				method: "POST",
				headers: {
					"Content-Type": "application/json",
					"xi-api-key": apiKey,
					Accept: "audio/mpeg",
				},
				body: JSON.stringify({
					text: text,
					model_id: "eleven_monolingual_v1",
				}),
			}
		);

		if (response.ok) {
			const audioBlob = await response.blob();
			const audioUrl = URL.createObjectURL(audioBlob);
			const audio = new Audio(audioUrl);
			audio.play();
		} else {
			const text = currentQuizWord;
			const speech = new SpeechSynthesisUtterance(text);
			speech.lang = "en-US"; // You can change to any language like "ja-JP", "fr-FR", etc.
			window.speechSynthesis.speak(speech);
		}
	}

	createSpeaker() {
		const speaker = document.createElement("div");
		speaker.classList.add("speaker");
		speaker.innerHTML = `
        <img src="http://192.168.1.12/spellable/assets/icons/speaker.png" alt="speaker">
    `;

		return speaker;
	}
}
