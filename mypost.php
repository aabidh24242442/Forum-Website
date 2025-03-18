<?php
session_start();

// IF USER IS NOT LOGGED IN SEND HIM TO THE LOGIN PAGE
if (!isset($_SESSION['user'])) {
    header('Location:index.php');
    die();
}

$pageName = "My Post";
include_once('dbh/dbdata.php');
include_once('includes/header.php');
?>

<h1 class="text-center my-5">My Post</h1>
<div class="row">
    <div class="col-sm-8 col-md-6 mx-auto">

        <?php
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

        //GETTING ALL MESSAGES
        $sql = "SELECT * FROM messages WHERE userID=$usersID ORDER BY id DESC";
        $result = $conn->query($sql);

        //CHECK IF ANY RESULTS WERE RETURNED FROM THE DATABASE
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $messageID = $row['id'];
                $message = $row['message'];
                $messageDateTime = $row['date Time'];

                //DISPLAY MESSAGE
        ?>
                <div class="card mb-3">
                    <div class="card-header d-flex">
                        Posted by: <?= $usersEmail ?>
                        <form action="dbh/messageDelete.php" class="ms-auto" method="POST">
                            <button type="submit" class="btn btn-danger" name='deleteBtn' value="<?= $messageID ?>">
                                Delete
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p><?= nl2br(htmlspecialchars($message)) ?></p>
                            <footer class="blockquote-footer fs-"><?= $messageDateTime ?></footer>
                        </blockquote>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "No message posted yet!";
        }
        ?>

        <?php
        include_once('includes/footer.php');
        include_once('includes/errorMessage.php');
        ?>