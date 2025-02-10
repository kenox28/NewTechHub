<?php

$hosts = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "progbook";

$connect = mysqli_connect($hosts, $dbusername, $dbpassword, $dbname);

if (!$connect) {
    echo "failed";
} else {
    // echo "success";

}
