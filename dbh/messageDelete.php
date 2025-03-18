<?php
session_start();
include('dbdata.php');

//GETTING USERS EMAIL FROM THE SESSION CONTAINING HIS EMAIL WHEN HE LOGGED IN
$usersEmail = $_SESSION['user'];

//FIND USERS ID FROM THE USERS TABLE USING HIS EMAIL
$sql2 = "SELECT id FROM user WHERE `email`='$usersEmail'";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $usersID = $row2['id'];
    }
}

//STORING VALUES OBTAINING VIA POST INTO A VARIABLE
$messageID = $conn->real_escape_string($_POST['deleteBtn']);

// sql to delete a record
$sql = "DELETE FROM `messages` WHERE id='$messageID' AND userID='$usersID'";
if ($conn->query($sql) === TRUE) {
    $_SESSION['status'] = "Message deleted successfully";
    header("Location:../mypost.php");
} else {
    $_SESSION['status'] = "Error deleting message: " . $conn->error;
    header("Location:../mypost.php");
}
