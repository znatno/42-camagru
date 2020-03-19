<?php

require 'app/lib/dev.php';

use app\core\Router;

function autoloader($class) {
	$path = str_replace('\\', '/', $class.'.php');
	if (file_exists($path)) {
		require $path;
	}
}

spl_autoload_register('autoloader');

session_start();

// debug($_SERVER);

$r = new Router();
$r->run();

?>
<br>
