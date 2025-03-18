<?php
function pageCheck($currentPage, $correctPage)
{
    if ($currentPage == $correctPage) {
        echo "active";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3393/3393948.png">
    <title><?= $pageName ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">Forum Sphere</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    //CHECK IF SESSION USER HAS A VALUE (SESSION USER GETS A VALUE WHENEVER HE LOGINS)
                    if (isset($_SESSION['user'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?php pageCheck($pageName, "Home Page") ?>" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php pageCheck($pageName, "My Post") ?>" aria-current="page" href="mypost.php">My Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link <?php pageCheck($pageName, "Login Page") ?>" aria-current="page" href="index.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php pageCheck($pageName, "Register Page") ?>" href="register.php">Register</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>