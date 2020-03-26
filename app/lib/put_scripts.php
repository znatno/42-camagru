<?php

// Getting all files inside directory. Similar to 'ls -la' in shell
$files = scandir('pub/scripts/');

// Remove '.' and '..' from array
unset($files[0]);
unset($files[1]);

// Put all files from directory
foreach ($files as $file) {
	echo '<script src="/pub/scripts/'.$file.'"></script>';
}
