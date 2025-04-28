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
        <title>home</title>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <!-- <link rel="stylesheet" href="1.css" /> -->
        <link rel="stylesheet" href="../css_techbook/homepage.css?v=1.0.3">
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
            <section id="GameDiv" style="display: none; border: 1px solid #ccc; padding: 10px; position: absolute; height: 90vh; width:98.5%; z-index:1; top:11%; background-color:green;">
                <button id="closeGameDiv" style="position: absolute; top: 5px; right: 10px;">✖</button>
                <div class="main">
                    <div class="main-menu">
                        <div class="menu-nav word-manager">Word Manager</div>
                        <div class="menu-nav quiz-manager">Quiz Manager</div>
                        <div class="menu-nav">Account Settings</div>
                        <a class="menu-nav logout" href="login_signup/logout.php">Logout</a>
                    </div>
                    <div class="main-menu-view">

                    </div>
                </div>
            </section>

        <?php include "header.php"?>
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
                <a id="sidebtnGameid" class="btn1" class="a">
                    <i id="iside" class="fa-solid fa-address-card"></i>
                    <i class="animation"></i>Game<i class="animation"></i>
                </a>

                
                <button id="titledivrank" onclick="showhomeside()">
                    <h1>Top Contributor</h1>
                </button>
                
                <div id="homedivside">
                <?php include "../newPhpfileTechhub/sideranksforuser.php"?>
                </div>
            </div>
            <div class="box1" id="PostContainer" data-aos="fade-up" data-aos-duration="1000">
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
            </form>


            <div id="allPOST">

            </div>
                <div id="loading" class="loading-overlay">
                    <div class="spinner"></div>
                </div>   
            </div>
            
            <div class="box2"  data-aos="fade-left" data-aos-duration="1000">
                <?php include "../newPhpfileTechhub/showaluser.php"?>
                
            </div>
        </main>
    </body>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://c61a-158-62-51-63.ngrok-free.app/spellable/js/spellable.js?v=1.0.1"></script>
    <script>
        const game = new WordQuizApp()
    </script>
    <script src="../techHUB_Javascripts/home.js?v=1.0.1"></script>

    
    
    
</html>
