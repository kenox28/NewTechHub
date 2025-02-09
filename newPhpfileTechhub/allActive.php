<?php

include_once "../database.php";

$sql3 = mysqli_query($connect, "SELECT * FROM account WHERE status = 'Active now'");

for ($i = 0; $row2 = mysqli_fetch_assoc($sql3); $i++) {

    ?>                
                    <div class="activeuser">
                        <a href="../newDesignTechbook/message.php?userid=<?php echo $row2['userid']; ?>" class="clickuser">
                            <img src="../profileimage/<?php echo $row2['img'] ?>" alt="" class="homeprofile" />
                            <div class="showname2">
                                <h1 class="actname"><?php echo $row2['fname'] . " " . $row2['lname'] ?>
                                </h1>
                            </div>
                            <div class="showstat">
                                <p>
                                    <?php echo $row2['status'] ?>
                            </p>
                            </div>
                        </a>
                    </div>
                
                <?php
}?>