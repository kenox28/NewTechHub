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
        <title>Message</title>
        <link rel="stylesheet" href="../css_techbook/1.css?v=1.0.2" />
        <link rel="stylesheet" href="../css_techbook/header.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
            integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer" />

    </head>

    <body>

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
            <!-- <div id="rdside">
                <button id="titledivrank" onclick="showhomeside()">
                    <h1>TOP RANK</h1>
                </button>
                <div id="homedivside">
                show top rank

                </div>
            </div> -->

            <div class="box2" data-aos="flip-left"  data-aos-duration="1000">
                <?php include "../newPhpfileTechhub/allActive.php"?>

            </div>
            <div id="messagediv" data-aos="zoom-in-up" data-aos-duration="1000" >
                <?php include "../newPhpfileTechhub/selectedChat.php"?>
                <div class="chatheader">
                    <a href="">
                        <img
                            src="../profileimage/<?php echo $selectCname['img'] ?>"
                            alt=""
                            class="homeprofile" />
                    </a>
                    <h1 class="actname1" id="actname1"><?php echo $selectCname['fname'] . " " . $selectCname['lname'] ?>
                    </h1>
                    <p id="mssgeactp"><?php echo $selectCname['status'] ?>
                    </p>
                </div>
                <div class="convodiv" id="convodiv">

                </div>
                <footer class="footerchat">
                    <form action="#" id="chatform" class="sendform" enctype="multipart/form-data" autocomplete="off">
                        <input type="text" name="sender" value="<?php echo $_SESSION['userid'] ?>" hidden>
                        <input type="text" name="reciever" value="<?php echo $selectCname['userid'] ?>" hidden>
                        <div class="container">
                            <input
                            required = ""
                            type="text"
                            name="message"
                            class="input"
                            id="messageinput"
                            placeholder="Message..."/>
                            <!-- <label class="label">Search</label> -->
                        </div>
                        <!-- <input
                            type="text"
                            name="message"
                            class="sendmessage"
                            id="messageinput"
                            placeholder="Message..." /> -->
                            <div class="divbutton">
                                <button type="submit" id="sendbtn" class="btn">
                                    <i class="animation"></i>Send<i class="animation"></i>
                                </button>
                                <!-- <button type="submit" id="sendbtn"><i class="fa-regular fa-paper-plane"></i></button> -->
                            </div>
                    </form>
                </footer>
            </div>
        </main>
    </body>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="../techHUB_Javascripts/message.js?v=1.0.1"></script>
</html>
