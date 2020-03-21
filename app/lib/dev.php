<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

function debug($str = '') {
	if (!empty($str)) {
		echo  '<pre>';
		var_dump($str);
		echo '</pre>';
	} else {
		echo '<hr><i style="color: red">debug() error</i><hr>';
	}
}

function getAllInfo() {
	echo "<b>Session:</b>";
	debug($_SESSION);
	echo "<b>Cookies:</b>";
	debug($_COOKIE);
	echo "<b>Server:</b>";
	debug($_SERVER);
}