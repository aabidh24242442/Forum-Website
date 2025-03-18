<?php
session_start();
include('dbdata.php');

// SANITIZING & STORING THE DATA
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);

//CHECK IF USER EXISTS
$sql = "SELECT `email` FROM `user` WHERE `email`='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //CHECK IF CREDINTIALS ARE CORRECT
    $sq12 = "SELECT `email` FROM `user` WHERE `email`='$email' AND `password`='$password'";
    $result2 = $conn->query($sq12);

    if ($result2->num_rows > 0) {
        $_SESSION['status'] = "Login Success";
        $_SESSION['user'] = $email;
        header("Location:../home.php");
    } else {
        $_SESSION['status'] = "Invalid Password";
        header("Location:../index.php");
    }
} else {
    $_SESSION['status'] = "User not registered";
    header("Location:../register.php");
}
