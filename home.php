<?php
session_start();

// IF USER IS NOT LOGGED IN SEND HIM TO THE LOGIN PAGE
if (!isset($_SESSION['user'])) {
    header('Location:index.php');
    die();
}

$pageName = "Home Page";
include_once('dbh/dbdata.php');
include_once('includes/header.php');
?>

<h1 class="text-center my-5">Home Page</h1>
<div class="row">
    <div class="col-sm-8 col-md-6 mx-auto">
        <form class="mb-5" action='dbh/messageCreate.php' method="POST">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Type something</label>
                <textarea name='message' class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <?php
        $sql = "SELECT * FROM messages ORDER BY id DESC";
        $result = $conn->query($sql);

        //CHECK IF ANY RESULTS WERE RETURNED FROM THE DATABASE
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $messageID = $row['id'];
                $message = $row['message'];
                $messageDateTime = $row['date Time'];
                $messageUserID = $row['userID'];

                //FINDING USERS EMAIL USING HIS ID
                $sql2 = "SELECT email FROM user WHERE `id`='$messageUserID'";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        $usersEmail = $row2['email'];
                    }
                } else {
                    $usersEmail = "Not Found";
                }

                //DISPLAY MESSAGE
        ?>
                <div class="card mb-3">
                    <div class="card-header">
                        Posted by: <?= $usersEmail ?>
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
        <!-- <div class="card mb-3">
            <div class="card-header">
                Posted by: aabidh1515@gmail.com
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>Welcome to Home Page</p>
                    <footer class="blockquote-footer fs-">28/08/2024 9:00 PM</footer>
                </blockquote>
            </div>
        </div>
    </div> -->
    </div>


    <?php
    include_once('includes/footer.php');
    include_once('includes/errorMessage.php');
    ?>