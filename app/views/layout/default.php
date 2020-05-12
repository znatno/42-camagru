<?php

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
    <meta charset="utf-8"/>
    <title><?= $title; ?></title>
    <link type="text/css" rel="stylesheet" href="/pub/css/stylesheet.css">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php require 'app/lib/put_scripts.php' ?>
</head>

<body>
<header>
    <div class="nav">
        <div class="container">
            <div class="row">
                <div class="col-4 col-md-2">
                    <a href="/"><img src="/pub/res/img/logo.svg" alt="Logo"></a>
                </div>
                <div class="col-4 col-md-4 p-0 nav-wrapper">
                    <div class="nav-links">
                        <a class="nav-links__item" href="/">Feed</a>
						<?= isset($_SESSION['user']) ? '<a href="/create/new" class="nav-links__item">New Post</a>' : '' ?>
                    </div>
                </div>
                <div class="col-4 ml-auto p-0 nav-wrapper">
                    <div class="nav-links float-right">
						<?= isset($_SESSION['user'])
                            ? '<a class="nav-links__item" href="/account/profile">'.$_SESSION['user']['username'].'</a>
                                <a class="nav-links__item" href="/account/logout">Log Out</a>'
                            : '<a class="nav-links__item" href="/account/login">Log In</a>
                                <a class="nav-links__item" href="/account/register">Sign Up</a>'
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<main role="main">
    <div id="snackbar">{Put text into the function}</div>
	<?= $content; ?>
    <footer class="container pt-4 my-md-5 pt-md-5 border-top">
        <p id="to-top-btn" class="float-right"><a href="#">Back to top</a></p>
        <p>© 2020 — 42 Camagru · <a href="https://t.me/znatno" target="_blank">Telegram</a> · <a href="https://github.com/znatno" target="_blank">GitHub</a></p>
    </footer>
</main>
</body>
</html>


