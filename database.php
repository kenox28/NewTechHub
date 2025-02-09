<?php

$host = "192.168.1.6:3306";
$dbusername = "marba";
$dbpassword = "password";
$dbname = "javas";

$connect = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

if (!$connect) {
    echo "failed";
} else {
    // echo "success";

}
