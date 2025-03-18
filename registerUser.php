<?php
session_start();
include('dbdata.php');

// STORING VALUES OBTAINED VIA POST INTO A VARIABLE
$email = $conn->real_escape_string($_POST['email']);
$password1 = $conn->real_escape_string($_POST['password1']);
$password2 = $conn->real_escape_string($_POST['password2']);

//CHECK IF USER EXISTS
$sql = "SELECT `email` FROM `user` WHERE `email`='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['status'] = "User already exsists";
    header("Location:../index.php");
} else {

    // CHECK IF PASSWORD AND CONFIRM PASSWORD MATCHES
    if ($password1 == $password2) {
        $sql = "INSERT INTO user (`email`, `password`)
            VALUES ('$email', '$password1')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['status'] = "New record created successfully";
            $_SESSION['user'] = $email;
            header("Location:../home.php");
        } else {
            $_SESSION['status'] = "Error: " . $sql . "<br>" . $conn->error;
            header("Location:../register.php");
        }
    } else {
        $_SESSION['status'] = "Password does not match";
        header("Location:../register.php");
    }
}
