<?php
session_start();
// if wala naka login para no error mo balik sa loginpage
if (!isset($_SESSION['userid'])) {
    header("location:../newDesignTechbook/home.php");
    exit();
}

include "../database.php";
$sender = mysqli_real_escape_string($connect, $_POST['sender']);
$receiver = mysqli_real_escape_string($connect, $_POST['reciever']);

$output = '';
$sql = mysqli_query($connect, "SELECT * FROM account WHERE userid = '{$_SESSION['userid']}'");
$picuser = mysqli_fetch_assoc($sql);
// to show picture of user na nag login

$sql5 = "SELECT * FROM tb_message LEFT JOIN account ON account.userid = tb_message.sender_Id WHERE (sender_Id = {$sender} AND receiver_id = {$receiver}) OR (sender_Id = {$receiver} AND receiver_id = {$sender}) ORDER BY id_msg";

if ($r = mysqli_query($connect, $sql5)) {
    $numRows = mysqli_num_rows($r);
    for ($w = 0; $w < $numRows; $w++) {
        $columnname = mysqli_fetch_assoc($r);
        if ($columnname['sender_Id'] === $sender) {
            $output .= '<div class="chats">
                            <div class="chatdivm">
                                <p id="chatid">
                                    ' . $columnname['messages'] . '
                                </p>
                            </div>
                            <img src="../profileimage/' . $picuser['img'] . '" alt="" id="chatimg" />
                        </div>';
        } else {
            $output .= '<div class="chatr">
                        <img src="../profileimage/' . $columnname['img'] . '" alt="" id="chatimg" />
                            <div class="chatdivm">
                            <p id="chatid">
                                ' . $columnname['messages'] . '

                            </p>
                            </div>
                        </div>';
        }
    }

    echo $output;

}
