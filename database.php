<?php

$hosts = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "progbook";

$connect = mysqli_connect($hosts, $dbusername, $dbpassword, $dbname);

if (!$connect) {
    echo "failed";
} else {
    // // echo "success";
    // $createAccountTable = "CREATE TABLE IF NOT EXISTS account (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     userid BIGINT NOT NULL,
    //     fname VARCHAR(255) NOT NULL,
    //     lname VARCHAR(255) NOT NULL,
    //     email VARCHAR(255) NOT NULL UNIQUE,
    //     password VARCHAR(255) NOT NULL,
    //     img VARCHAR(255) DEFAULT 'noprofile.jpg',
    //     gender VARCHAR(10),
    //     bdate DATE,
    //     dateadded DATETIME DEFAULT CURRENT_TIMESTAMP,
    //     number VARCHAR(20),
    //     status VARCHAR(50)
    // )";
    
    
    // $createRankingTable = "CREATE TABLE IF NOT EXISTS ranking (
    //     rank_id INT AUTO_INCREMENT PRIMARY KEY,
    //     fname VARCHAR(255) NOT NULL,
    //     lname VARCHAR(255) NOT NULL,
    //     ranks VARCHAR(50) NOT NULL,
    //     Percent FLOAT NOT NULL,
    //     date_added DATETIME DEFAULT CURRENT_TIMESTAMP
    // )";
    
    // $createUserInfoTable = "CREATE TABLE IF NOT EXISTS userinfo (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     userid BIGINT NOT NULL,
    //     fname VARCHAR(255) NOT NULL,
    //     lname VARCHAR(255) NOT NULL,
    //     address TEXT,
    //     course VARCHAR(100),
    //     pl VARCHAR(100),
    //     sectionyr VARCHAR(50)
    // )";
    
    
    // // Execute the table creation queries
    // mysqli_query($connect, $createAccountTable);
    // mysqli_query($connect, $createRankingTable);
    // mysqli_query($connect, $createUserinfoTable);
    // $createNewsfeedTable = "CREATE TABLE IF NOT EXISTS newsfeed (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     userid BIGINT NOT NULL,
    //     fname VARCHAR(255) NOT NULL,
    //     lname VARCHAR(255) NOT NULL,
    //     img1 VARCHAR(255) DEFAULT 'noprofile.jpg',
    //     react INT(11) DEFAULT 0,
    //     cappost TEXT,
    //     imgpost VARCHAR(255),
    //     posted_at DATETIME DEFAULT CURRENT_TIMESTAMP
    // )";
    // mysqli_query($connect, $createNewsfeedTable);
    
    // $createRankingTable = "CREATE TABLE IF NOT EXISTS ranking (
    //     rank_id INT AUTO_INCREMENT PRIMARY KEY,
    //     fname VARCHAR(255) NOT NULL,
    //     lname VARCHAR(255) NOT NULL,
    //     ranks VARCHAR(50) NOT NULL,
    //     Percent FLOAT NOT NULL,
    //     date_added DATETIME DEFAULT CURRENT_TIMESTAMP
    // )";
    // mysqli_query($connect, $createRankingTable);
    // $createUserInfoTable = "CREATE TABLE IF NOT EXISTS userinfo (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     userid BIGINT NOT NULL,
    //     fname VARCHAR(255) NOT NULL,
    //     lname VARCHAR(255) NOT NULL,
    //     address TEXT,
    //     course VARCHAR(100),
    //     pl VARCHAR(100),
    //     sectionyr VARCHAR(50)
    // )";
    // mysqli_query($connect, $createUserInfoTable);
    // $createMessageTable = "CREATE TABLE IF NOT EXISTS tb_message (
    //     id_msg INT AUTO_INCREMENT PRIMARY KEY,
    //     sender_Id VARCHAR(255) NOT NULL,
    //     receiver_id VARCHAR(255) NOT NULL,
    //     messages VARCHAR(255) NOT NULL,
    //     dateMsent DATETIME DEFAULT CURRENT_TIMESTAMP
    // )";
    // mysqli_query($connect, $createMessageTable);
    // $createFeedbackMessageTable = "CREATE TABLE IF NOT EXISTS feedbackmessage (
    //     id INT AUTO_INCREMENT PRIMARY KEY,
    //     userid VARCHAR(255) NOT NULL,
    //     fname VARCHAR(255) NOT NULL,
    //     lname VARCHAR(255) NOT NULL,
    //     img VARCHAR(255) DEFAULT 'noprofile.jpg',
    //     feedback TEXT NOT NULL,
    //     rating INT(11) NOT NULL,
    //     datefeedback DATETIME DEFAULT CURRENT_TIMESTAMP
    // )";
    // mysqli_query($connect, $createFeedbackMessageTable);
        

}
