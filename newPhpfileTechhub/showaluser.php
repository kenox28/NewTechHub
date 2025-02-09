<?php

include_once "../database.php";

$sql3 = mysqli_query($connect, "SELECT * FROM account");

for ($i = 0; $userC = mysqli_fetch_assoc($sql3); $i++) {

    ?>
        <div class="activeuser">
            <a href="../newDesignTechbook/message.php?userid=<?php echo $userC['userid']; ?>" class="clickuser">
                <img src="../profileimage/<?php echo $userC['img'] ?>" alt="" class="homeprofile" />
                <div class="showname">
                    <h1 class="actname">
                        <?php echo $userC['fname'] . " " . $userC['lname'] ?>
                        
                    </h1>
                </div>
                <div class="showstat">

                    <p><?php echo $userC['status'] ?></p>
                </div>

            </a>
        </div>
        
        <?php
}?>