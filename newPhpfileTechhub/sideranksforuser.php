<?php
include "../database.php";

$sqlforall = mysqli_query($connect, "SELECT * FROM ranking WHERE ranks = 'SENIOR DEV'");
$num_rows = mysqli_num_rows($sqlforall);

for ($i = 0; $i < $num_rows; $i++) {
    $allb = mysqli_fetch_assoc($sqlforall);
    $sqlforimage = mysqli_query($connect, "SELECT * FROM account WHERE userid = '{$allb['rank_id']}'");
    if ($imr = mysqli_fetch_assoc($sqlforimage)) {
        ?>
        <div id="rankinghomediv">
            <div></div>
            <a href="../newDesignTechbook/profilepage.php?userid=<?php echo $imr['userid']; ?>" style="text-decoration: none; color: inherit; display: flex; align-items: center; justify-content: center; ">
            <img src="../profileimage/<?php echo $imr['img'] ?>" alt="" id="rim" class="homeprofile">
            </a>
        
            <div id="dr">
                <p id="rankhome">
                    <?php echo $allb['ranks'] ?>
                    <!-- Expert -->
                
                </p>
            </div>
            
        </div>

<?php
}
}
?>