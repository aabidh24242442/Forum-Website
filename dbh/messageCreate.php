<?php
session_start();
include('dbdata.php');

date_default_timezone_set("Asia/Colombo");
$datePosted = date("Y-m-d H:i:s");
$message = $conn->real_escape_string($_POST['message']);
$email = $conn->real_escape_string($_SESSION['user']);

// GET USERS ID FROM THE DATABASE USING HIS EMAIL
$sql = "SELECT id FROM user WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // STORING THE USERS ID INTO THE USERID VARIABLE
    while ($row = $result->fetch_assoc()) {
        $userID = $row["id"];
    }

    // STORE THE MESSAGE INTO OUR DATABASE
    $sql2 = "INSERT INTO `messages`(`message`, `date Time`, `userID`) 
            VALUES ('$message','$datePosted','$userID')";

    if ($conn->query($sql2) === TRUE) {
        $_SESSION['status'] = "Message posted successfully";
        header("Location:../home.php");
    } else {
        $_SESSION['status'] = "Message not posted: " . $sql . "<br>" . $conn->error;
        header("Location:../home.php");
    }
}
