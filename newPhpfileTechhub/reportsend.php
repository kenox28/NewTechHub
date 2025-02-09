<?php
include "../database.php";

$messageforadmin = mysqli_real_escape_string($connect, $_POST['messageforadmin']);

if (!empty($messageforadmin)) {
    echo 'run';
    $reportsender = mysqli_real_escape_string($connect, $_POST['reportsender']);
    $sql = mysqli_query($connect, "SELECT * FROM account WHERE userid = '$reportsender'");

    $reportc = mysqli_fetch_assoc($sql);

    $sql2 = mysqli_query($connect, "INSERT INTO reportmessage (userid,fname,lname,img,report)VAlUES('{$reportc['userid']}','{$reportc['fname']}','{$reportc['lname']}','{$reportc['img']}','{$messageforadmin}')");

} else {
    ?>
    <script>
        
        alert('failed');
    </script>


    <?php
}
?>