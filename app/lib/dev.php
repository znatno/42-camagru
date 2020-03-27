<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

function debug($str = '') {
	if (!empty($str)) {
		echo  '<pre>';
		var_dump($str);
		echo '</pre>';
	} else {
		echo '<hr><i style="color: red">variable don\'t exist</i><hr>';
		return false;
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

function upload_file() {
	if (isset($_POST['submit'])) {
		$file = $_FILES['file'];
		$fileName = $file['name'];
		$fileTmpName = $file['tmp_name'];
		$fileSize = $file['size'];
		$fileError = $file['error'];
		$fileType = $file['type'];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));
		$allowedExt = ['jpg', 'jpeg', 'png'];

		if (in_array($fileActualExt, $allowedExt)) {
			if ($fileError === 0) {
				if ($fileSize > 5000) {
					$fileNewName = uniqid('', true) . ".$fileActualExt";
					$fileDestination = "pub/photos/$fileNewName";
					move_uploaded_file($fileTmpName, $fileDestination);
					//$this->view->message("Success", "The file has been uploaded");
				} else {
					echo "error1";
					//$this->view->message("Error", "The file is overweight. Please, upload files smaller 5mb");
				}
			} else {
				echo "error2";
				//$this->view->message("Error", "Uploading has been interrupted. Please, try again");
			}
		} else {
			echo "error3";
			//$this->view->message("Error", "Forbidden file extension. Allowed: jpg, jpeg, png");
		}
	}
}