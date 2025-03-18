<?php
session_start();

// CHECK IF USER IS LOGGED IN, IF SO REDIRECT HIM TO HOME PAGE
if (isset($_SESSION['user'])) {
    $_SESSION['status'] = "User is logged in already";
    header('Location:home.php');
    die();
}

$pageName = "Register Page";
include_once('includes/header.php');
?>

<h1 class="text-center my-5">Register Page</h1>
<div class="row">
    <form class="col-sm-6 col-lg-4 mx-auto" action="dbh/registerUser.php" method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password1" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="password2" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

<?php
include_once('includes/footer.php');
include_once('includes/errorMessage.php');
?>