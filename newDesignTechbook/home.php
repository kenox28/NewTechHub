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
        <title>home</title>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <!-- <link rel="stylesheet" href="1.css" /> -->
        <link rel="stylesheet" href="../css_techbook/homepage.css?v=1.0.4">
        <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->
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
                    <!-- Add search toggle button -->
            <!-- <div id="search-toggle">
                <i class="fas fa-search"></i>
            </div> -->

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
                    </div>
                </form>
                <div class="search3" id="serc"></div>
            </div>
            <div id="listheader1">
                
                <a href="home.php"  title="Home"><i class="fa fa-house"></i></a>
                <a href="message.php?userid=<?php echo $_SESSION['userid']; ?>" title="Messages"><i class="fa-regular fa-envelope"></i></a>
                <a href="Leaderboards.php" title="Leaderboards"><i class="fa-solid fa-user-tie"></i></a>
                <a href="TopPost.php" id="toppost" title="Top Posts"><i class="fa-solid fa-chart-column"></i></a>
                <a href="NewsApi.php" id="news" title="News"><i class="fa-solid fa-newspaper"></i></a>

            </div>
            <div id="idprodiv">
                <?php include "../newPhpfileTechhub/headerfetechdata.php"?>

                <a href="#" id="profile">
                    <img src="../profileimage/<?php echo $userCname['img'] ?>" alt="" id="homeprofile" />
                </a>

                <div id="divshow">
                    <a href="../newDesignTechbook/profilepage.php?userid=<?php echo $_SESSION['userid']; ?>" class="a"><i class="fa-solid fa-user"></i><p class="pa">PROFILE</p></a>
                    <a href="../newDesignTechbook/EditProfilepage.php?userid=<?php echo $_SESSION['userid']; ?>" class="a"><i class="fa-solid fa-address-card"></i><p class="pa">EDIT PROFILE</p></a>
                    <a href="#" id="showrepordiv" class="a"><i class="fa-solid fa-message"></i>
                        <p class="pa">REPORT</p>
                    </a>
                    
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
            <div id="rdside"  data-aos="fade-right" data-aos-duration="1000">
            
                <a id="sidebtn" class="btn1" href="profilepage.php?userid=<?php echo $_SESSION['userid']; ?>" class="a"><i id="iside" class="fa-solid fa-user"></i><i class="animation"></i>PROFILE<i class="animation"></i></a>
                <a id="sidebtn" class="btn1" href="Editprofilepage.php?userid=<?php echo $_SESSION['userid']; ?>" class="a"><i id="iside" class="fa-solid fa-address-card"></i><i class="animation"></i>EditPROFILE<i class="animation"></i></a>
                <a class="btn1 a" id="showrepordiv-side" href="#">
                    <i id="iside" class="fa-solid fa-message"></i>
                    <i class="animation"></i>REPORT<i class="animation"></i>
                </a>
                
                <button id="titledivrank" onclick="showhomeside()">
                    <h1>Top Contributor</h1>
                </button>
                
                <div id="homedivside">
                
                <?php include "../newPhpfileTechhub/sideranksforuser.php"?>


                </div>
            </div>

            <div class="box1" data-aos="fade-up" data-aos-duration="1000">
            <form action="#" class="postfeed" id="postfeed" enctype="multipart/form-data">
                <div class="container">
                    <input
                        required=""
                        type="text"
                        name="cappost"
                        class="input"
                        id="captadd" />
                    <label class="label">POST YOUR CODE</label>
                </div>
                <!-- <label for="captadd" id="captaddlabel">POST YOUR CODE</label> -->
                <!-- <input type="text" id="captadd" name="cappost" placeholder="Write your code"  /> -->
                <div class="container">
                    <input required="" type="file" name="imgpost" id="idimage" class="input"/>
                    
                </div>
                <div class="divbutton">
					<button type="submit" id="captbtn" class="btn">
                        <i class="animation"></i>POST<i class="animation"></i>
					</button>
				</div>
                <!-- <button id="captbtn" type="submit"><i class="fa-solid fa-thumbtack"></i></button> -->
            </form>

                <?php include "../newPhpfileTechhub/showallPOST.php"?>
                


            </div>
            
            <div class="box2"  data-aos="fade-left" data-aos-duration="1000"    >
                <?php include "../newPhpfileTechhub/showaluser.php"?>
                
            </div>
        </main>
    </body>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="../techHUB_Javascripts/home.js?v=1.0.2"></script>
</html>
