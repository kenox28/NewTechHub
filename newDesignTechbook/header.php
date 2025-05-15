<header>
    <?php include "../newPhpfileTechhub/headerfetechdata.php" ?>
    <h1 id="logo"><img src="../profileimage/techhubBLACK.png" height="40px" style="padding: 2px;"></h1>
    <div id="listheader2">
        <form action="" id="searchform">
            <div class="container">
                <input
                    required=""
                    type="text"
                    name="searchterm"
                    class="input"
                    id="searchbar"
                    placeholder="Search" />
            </div>
        </form>
        <div class="search3" id="serc"></div>
    </div>
    <div id="listheader1">

        <a href="home.php" title="Home"><i class="fa fa-house"></i></a>
        <a href="message.php?userid=<?php echo $_SESSION['userid']; ?>" title="Messages"><i class="fa-regular fa-envelope"></i></a>
        <a href="Leaderboards.php" title="Leaderboards"><i class="fa-solid fa-user-tie"></i></a>
        <a href="TopPost.php" id="toppost" title="Top Posts"><i class="fa-solid fa-chart-column"></i></a>
        <a href="NewsApi.php" id="news" title="News"><i class="fa-solid fa-newspaper"></i></a>

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