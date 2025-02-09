<?php

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "progbook";

$connect = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

if (!$connect) {
    echo "failed";
} else {
    // echo "success";

}
