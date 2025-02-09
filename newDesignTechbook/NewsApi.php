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
        <title>News papge</title>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <!-- <link rel="stylesheet" href="1.css" /> -->
        <link rel="stylesheet" href="../css_techbook/toppost.css?v=1.0.4">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
            integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer" />
    </head>
    <link rel="html" href="home.html">

    <body>
        <header>
            <?php include "../newPhpfileTechhub/headerfetechdata.php"?>
            <h1 id="logo"><img src="../profileimage/techhubBLACK.png" height="40px" style="padding: 2px;"></h1>
            <div id="listheader2">
                <form action="">
                    <div class="container">
                        <input
                        required = ""
                        type="text"
                        name="searchterm"
                        class="input"
                        id="searchbar"
                        placeholder="Search"/>
                        <!-- <label class="label">Search</label> -->
                    </div>
                    <!-- <input
                        type="text"
                        name="searchterm"
                        class="input"
                        id="searchbar"
                        placeholder="Search..."/> -->
                </form>
                <div class="search3" id="serc">

                </div>
            </div>
            <div id="listheader1">
                
                <a href="home.php"><i class="fa fa-house"></i></a>
                <a href="message.php?userid=<?php echo $_SESSION['userid']; ?>"><i class="fa-regular fa-envelope"></i></a>
                <a href="Leaderboards.php"><i class="fa-solid fa-user-tie"></i></a>
                <a href="TopPost.php" id="toppost"><i class="fa-solid fa-chart-column"></i></a>
                <a href="NewsApi.php" id="news"><i class="fa-solid fa-newspaper"></i></a>

            </div>
            <div id="idprodiv">
                <?php include "../newPhpfileTechhub/headerfetechdata.php"?>

                <a href="#" id="profile">
                    <img src="../profileimage/<?php echo $userCname['img'] ?>" alt="" id="homeprofile" />
                </a>

                <div id="divshow">
                    <a href="../newDesignTechbook/profilepage.php?userid=<?php echo $_SESSION['userid']; ?>" class="a"><i class="fa-solid fa-user"></i><p class="pa">PROFILE</p></a>
                    <a href="../newDesignTechbook/EditProfilepage.php?userid=<?php echo $_SESSION['userid']; ?>" class="a"><i class="fa-solid fa-address-card"></i><p class="pa">EDIT PROFILE</p></a>
                    <a href="#" id="showrepordiv" class="a"><i class="fa-solid fa-message"></i><p class="pa">REPORT</p></a>
                    
                    <a href="#" class="a" id="feedbackdiv"><i class="fa-regular fa-circle-question"></i><p class="pa">FEEDBACK</p></a>
                    <a href="#" class="a" id="logout"><i class="fa-solid fa-right-from-bracket"></i><p class="pa">LOGOUT</p></a>
                </div>
            </div>
        </header>
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

            <div class="newspost" data-aos="fade-up" data-aos-duration="1000">
                <div id="news-container">
                    <!-- News will be loaded here -->
                    <div class="loading">
                        <i class="fas fa-spinner fa-spin"></i>
                        Loading news...
                    </div>
                </div>
            </div>
            <div class="box2"  data-aos="fade-left" data-aos-duration="1000"    >
                <?php include "../newPhpfileTechhub/showaluser.php"?>
                
            </div>
            <!-- <div id="rdside"  data-aos="fade-right" data-aos-duration="1000">

            </div> -->
            

        </main>
    </body>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="../techHUB_Javascripts//News.js"></script>




</html>
