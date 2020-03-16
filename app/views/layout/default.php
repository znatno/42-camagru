<?php //debug($_SESSION); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- JS -->
    <!--    <script type="text/javascript" src="/pub/scripts/jquery.js"></script>-->
    <!--    <script type="text/javascript" src="/pub/scripts/form.js"></script>-->

</head>

<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Camagru</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/create/new">New Post</a>
            </li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
			<?php
			if (isset($_SESSION['user'])) {
				echo
				'<li class="nav-item"><a class="nav-link" href="/account/profile">'.$_SESSION['user']['username'].'</a></li>';
			} else {
			    echo
                '<li class="nav-item"><a class="nav-link" href="/account/register">Sign Up</a></li>
                 <li class="nav-item"><a class="nav-link" href="/account/login">Login</a></li>';
            }
			?>

        </ul>
    </div>
</nav>

<body>
    <?php echo $content; ?>
</body>

</html>


