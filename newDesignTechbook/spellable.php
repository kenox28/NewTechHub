<?php
session_start();
// if wala naka login para no error mo balik sa loginpage
if (!isset($_SESSION['userid'])) {
    header("location:login.php");
    exit();
}
header("Access-Control-Allow-Origin: *");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Spellable</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="1.css" /> -->
    <link rel="stylesheet" href="../css_techbook/homepage.css?v=1.0.3">
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../css_techbook/feedback&report.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="http://192.168.1.12/spellable/assets/home.css">
    <link rel="stylesheet" href="http://192.168.1.12/spellable/assets/admin_dashboard.css">
    <link rel="stylesheet" href="http://192.168.1.12/spellable/assets/word_manager.css">
    <link rel="stylesheet" href="http://192.168.1.12/spellable/assets/quiz_manager.css">
    <link rel="stylesheet" href="http://192.168.1.12/spellable/assets/account_settings.css">
    <link rel="stylesheet" href="http://192.168.1.12/spellable/assets/user_page.css">
    <link rel="stylesheet" href="http://192.168.1.12/spellable/assets/speaker.css">
    <link rel="stylesheet" href="http://192.168.1.12/spellable/assets/modal.css">
    <link rel="stylesheet" href="http://192.168.1.12/spellable/assets/game.css">
    <link rel="stylesheet" href="http://192.168.1.12/spellable/assets/button.css">
    <link rel="stylesheet" href="http://192.168.1.12/spellable/assets/card.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<link rel="html" href="home.html">

<body>
    

    <?php include "header.php" ?>
    <main>
        <section id="GameDiv" style="display: flex; position: absolute; height: 100%; width:98.5%; z-index:1; top:11%; background-color:green;">
            <div class="flash-message"></div>
            <!-- <button id="closeGameDiv" style="position: absolute; top: 5px; right: 10px;">✖</button> -->
            <div class="main spellable" style="padding: 0; margin:0;">
                <div class="header">
                    <h1>Spellable</h1>
                    <div class="account-settings">
                        <div class="logout-btn">
                            Logout
                        </div>
                    </div>
                </div>
                <div class="main">
                    
                </div>
            </div>
        </section>
        <div id="reportmessage">
            <div id="btnforx">
                <a href="#" id="closedivreport"><i id="btnforback" class="fa fa-circle-xmark"></i></a>
            </div>
            <div>
                <form action="#" id="formesreport">
                    <label for="chatadmin" id="labelrpt">Reports</label>

                    <textarea id="chatadmin" placeholder="Report a message here" name="messageforadmin"></textarea>
                    <input type="text" value="<?php echo $_SESSION['userid'] ?>" hidden name="reportsender">
                    <div id="divforbtnx">
                        <button type="submit" id="btnforreports">SEND </button>
                    </div>
                </form>
            </div>
        </div>
        </div>

        <div id="feedbackModal">
            <div id="btnforx">
                <a href="#" id="closeFeedback"><i id="btnforback" class="fa fa-circle-xmark"></i></a>
            </div>
            <div>
                <form action="#" id="feedbackForm">
                    <label for="feedbackStars" id="labelrpt">Feedback</label>
                    <!-- Remove duplicate input, keep only one -->
                    <input type="text" value="<?php echo $_SESSION['userid'] ?>" hidden name="feedback_sender">

                    <div class="star-rating" id="feedbackStars">
                        <input type="radio" id="star5" name="rating" value="5" required>
                        <label for="star5"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1"><i class="fas fa-star"></i></label>
                    </div>
                    <div class="rating-text" id="ratingText">No rating selected</div>

                    <textarea id="chatadmin" placeholder="Share your feedback here..." name="feedback_message"></textarea>

                    <div id="divforbtnx">
                        <button type="submit" id="btnforreports">SEND</button>
                    </div>
                </form>
            </div>
        </div>

    </main>
</body>
<!-- <script src="http://192.168.1.12/spellable/js/spellable_cms.js"></script> -->
 <script src="../techHUB_Javascripts/spellablegame.js"></script>
<script>
    const game = new WordQuizApp()
    
    

    async function getCurrentUser() {
		const formData = new FormData();
		formData.append("action", "current_user");

		const response = await fetch("../integ/post.php", {
			method: "POST",
			body: formData,
		});

		return await response.json();
	}


    async function init() {
        try {
            const data = await getCurrentUser();
            const user = data.user
            console.log(user); // <--- This should be the parsed JSON object

            console.log(user.fname)
        
            const register = await game.fetchData([
                ["action", "registerTechHub"],
                ["fname", user.fname],
                ["mname", user.lname],
                ["lname", user.lname],
                ["email", user.email],
                ["username", user.email],
                ["password", user.password],
                ["confirmpassword", user.password]
            ])
            

            console.log(register)
            game.userId = register.user.id
        } catch (error) {
            console.error("Failed to get user:", error);
        }

        
    }

    init();




    game.user_init()
    console.log(game.user_init)
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- <script src="../techHUB_Javascripts/spellable.js"></script> -->




</html>