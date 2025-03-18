<?php
session_start();


// CHECK IF USER IS LOGGED IN, IF SO REDIRECT HIM TO HOME PAGE
if (isset($_SESSION['user'])) {
  $_SESSION['status'] = "User is logged in already";
  header('Location:home.php');
  die();
}

$pageName = "Login Page";
include_once('includes/header.php');
?>

<h1 class="text-center my-5">Login Page</h1>
<div class="row">
  <form class="col-sm-6 col-lg-4 mx-auto" action='dbh/userLogin.php' method="POST">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
  </form>
</div>

<?php
include_once('includes/footer.php');
include_once('includes/errorMessage.php');
?>