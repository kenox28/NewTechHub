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
    <title>profile</title>
    <link rel="stylesheet" href="../css_techbook/header.css?v=1.0.2">
    <link rel="stylesheet" href="../css_techbook/profilepage.css?v=1.0.4" />
    <link rel="stylesheet" href="../css_techbook/feedback&report.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
</head>


<body>
    <header>
        <?php include "../newPhpfileTechhub/headerfetechdata.php" ?>
        <h1 id="logo"><img src="../profileimage/techhubBLACK.png" height="40px" style="padding: 2px;"></h1>
        <div id="listheader2">
            <form action="">
                <div class="container">
                    <input
                        required=""
                        type="text"
                        name="searchterm"
                        class="input"
                        id="searchbar"
                        placeholder="Search" />
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
            <?php include "../newPhpfileTechhub/headerfetechdata.php" ?>

            <a href="#" id="profile">
                <img src="../profileimage/<?php echo $userCname['img'] ?>" alt="" id="homeprofile" />
            </a>

            <div id="divshow">
                <a href="../newDesignTechbook/profilepage.php?userid=<?php echo $_SESSION['userid']; ?>" class="a"><i class="fa-solid fa-user"></i>
                    <p class="pa">PROFILE</p>
                </a>
                <a href="../newDesignTechbook/EditProfilepage.php?userid=<?php echo $_SESSION['userid']; ?>" class="a"><i class="fa-solid fa-address-card"></i>
                    <p class="pa">EDIT PROFILE</p>
                </a>
                <a href="#" id="showrepordiv" class="a"><i class="fa-solid fa-message"></i>
                    <p class="pa">REPORT</p>
                </a>

                <a href="#" class="a" id="feedbackdiv"><i class="fa-regular fa-circle-question"></i>
                    <p class="pa">FEEDBACK</p>
                </a>

                <a href="#" class="a" id="logout"><i class="fa-solid fa-right-from-bracket"></i>
                    <p class="pa">LOGOUT</p>
                </a>
            </div>
        </div>
    </header>


    <main id="mainp">
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
        <section
            id="sidep"
            data-aos="fade-right"
            data-aos-offset="300"
            data-aos-easing="ease-in-sine">
            <?php include "../newPhpfileTechhub/selectedChat.php" ?>
            <div class="profilecontainer">
                <div class="profile-header">
                    <img src="../profileimage/<?php echo $selectCname['img']; ?>" alt="" id="pimg" />
                </div>
                <div id="dprof">
                    <div class="name-message-container">
                        <h1 id="pname">
                            <?php echo $selectCname['fname'] . " " . $selectCname['lname'] ?>
                        </h1>
                        <a href="message.php?userid=<?php echo $selectCname['userid']; ?>" class="message-icon" title="Send Message">
                            <i class="fa-regular fa-paper-plane"></i>
                        </a>
                    </div>
                    <?php include "../newPhpfileTechhub/rankinprofile.php" ?>
                    <p id="Prank">
                        <?php echo $rankuserc['ranks'] ?>
                    </p>
                    <p id="pstat">
                        <?php echo $selectCname['status'] ?>
                    </p>

                    <?php include "../newPhpfileTechhub/countpost.php" ?>
                    <div class="achievement-stars">
                        <?php
                        // Display 3 stars, colored based on achievement levels
                        for ($i = 1; $i <= 6; $i++) {
                            if ($total > 10 && $i <= 6) {
                                // All 6 icons gold for >10 posts
                                echo '<i class="fa-solid fa-star achievement-earned"></i>';
                            } elseif ($total >= 6 && $i <= 4) {
                                // 4 icons gold for 6-10 posts
                                echo '<i class="fa-solid fa-star achievement-earned"></i>';
                            } elseif ($total >= 3 && $i <= 2) {
                                // 2 icons gold for 3-5 posts
                                echo '<i class="fa-solid fa-star achievement-earned"></i>';
                            } else {
                                // Unearned icons remain gray
                                echo '<i class="fa-solid fa-star"></i>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div id="moreinfo">
                <?php include "../newPhpfileTechhub/showinfo.php" ?>

                <p class="pinfo" id="addp">Address:
                    <?php echo isset($userinfoc['address']) ? $userinfoc['address'] : 'N/A'; ?>
                </p>
                <p class="pinfo" id="plp">Programming language:
                    <?php echo isset($userinfoc['pl']) ? $userinfoc['pl'] : 'N/A'; ?>
                </p>
                <p class="pinfo" id="pc">Course:
                    <?php echo isset($userinfoc['course']) ? $userinfoc['course'] : 'N/A'; ?>
                </p>
                <p class="pinfo" id="psy">Section & yr:
                    <?php echo isset($userinfoc['sectionyr']) ? $userinfoc['sectionyr'] : 'N/A'; ?>
            </div>
        </section>

        <div id="postprodiv">
            <div id="timeline">
                <h1>TIMELINE</h1>
            </div>
            <!-- <header id="timeline"><h1>TIMELINE</h1></header> -->

            <div id="infop">
                <?php include "../newPhpfileTechhub/profiletimepost.php" ?>
            </div>
        </div>
        </div>
    </main>
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="../techHUB_Javascripts/profilepage.js?v=1.0.2"></script>

</html>