<?php
    // Check auth
//    debug($_SESSION);

    if (isset($_SESSION['user'])) {
        $check_login = '<li class="nav-item"><a class="nav-link" href="/account/profile">' . $_SESSION['user']['username'] . '</a></li><li class="nav-item"><a class="nav-link" href="/account/logout">Log Out</a></li>';
        $check_post = '<li class="nav-item"><a class="nav-link" href="/create/new">New Post</a></li>';
    } else {
        $check_login = '<li class="nav-item"><a class="nav-link" href="/account/register">Sign Up</a></li><li class="nav-item"><a class="nav-link" href="/account/login">Log In</a></li>';
		$check_post = '';
    }
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <title><?= $title; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <?php require 'app/lib/put_scripts.php' ?>
</head>

<nav class="navbar navbar-expand navbar-dark bg-dark">

    <a class="navbar-brand" href="/">Camagru</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Gallery</a>
            </li>
            <?= $check_post ?>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
			<?= $check_login ?>
        </ul>
    </div>

</nav>
<body>
    <?= $content; ?>
</body>
</html>


