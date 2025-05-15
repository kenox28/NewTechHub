<?php
session_start();
// if wala naka login para no error mo balik sa loginpage
if (!isset($_SESSION['userid'])) {
    header("location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Content ranking</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="1.css" /> -->

    <link rel="stylesheet" href="../css_techbook/toppost.css?v=1.0.2">
    <link rel="stylesheet" href="../css_techbook/header.css">
    <link rel="stylesheet" href="../css_techbook/feedback&report.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
</head>
<link rel="html" href="home.html">

<body>
    <?php include "header.php" ?>
    <main>
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
        <div id="rdside" data-aos="fade-right" data-aos-duration="1000">

            <a id="sidebtn" class="btn1" href="profilepage.php?userid=<?php echo $_SESSION['userid']; ?>" class="a"><i id="iside" class="fa-solid fa-user"></i><i class="animation"></i>PROFILE<i class="animation"></i></a>
            <a id="sidebtn" class="btn1" href="Editprofilepage.php?userid=<?php echo $_SESSION['userid']; ?>" class="a"><i id="iside" class="fa-solid fa-address-card"></i><i class="animation"></i>EditPROFILE<i class="animation"></i></a>
            <a class="btn1 a" id="showrepordiv-side" href="#">
                <i id="iside" class="fa-solid fa-message"></i>
                <i class="animation"></i>REPORT<i class="animation"></i>
            </a>
            <button id="titledivrank" onclick="showhomeside()">
                <h1>TOP USER</h1>
            </button>

            <div id="homedivside">

                <?php include "../newPhpfileTechhub/sideranksforuser.php" ?>


            </div>
        </div>

        <div id="boxtoppost" class="boxtoppost" data-aos="fade-up" data-aos-duration="1000">





        </div>
        <div id="loading" class="loading-overlay">
            <div class="spinner"></div>
        </div>

    </main>
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="../techHUB_Javascripts/toppost.js?v=1.0.5"></script>

</html>