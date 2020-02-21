<?php

require 'app/lib/dev.php';

use app\core\Router;

spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

session_start();

$r = new Router();
$r->run();




?>
<br>
