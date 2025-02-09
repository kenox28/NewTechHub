
<?php
session_start();
include "../database.php";

if (isset($_POST['searchterm'])) {
    $searchinputed = mysqli_real_escape_string($connect, $_POST['searchterm']);

    $searched = '';

    $sql = mysqli_query($connect, "SELECT * FROM account WHERE fname LIKE '%{$searchinputed}%' OR lname LIKE '%{$searchinputed}%'");

    $num_rows = mysqli_num_rows($sql);
    for ($i = 0; $i < $num_rows; $i++) {
        $row = mysqli_fetch_assoc($sql);

        $searched .='<div class="searchuserA">
                        <a href="../newDesignTechbook/profilepage.php?userid=' . $row['userid'] . '" class="clickuser">
                        <img src="../profileimage/' . $row['img'] . '" alt="" class="homeprofile" />
                        <div class="showname">
                            <h1 class="actname">' . $row['fname'] . " " . $row['lname'] . '</h1>
                        </div>
                        </a>
                    </div>';

    }
    echo $searched;
}
?>