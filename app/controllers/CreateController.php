<?php


namespace app\controllers;

use app\core\Controller;

class CreateController extends Controller {

	public function newPostAction() {
		$this->view->render('New Post', []);
	}

	// upload to the app
	public function uploadFileAction() {
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
						$fileNewName = uniqid('', true).".$fileActualExt";
						$fileDestination = "pub/photos/$fileNewName";
						move_uploaded_file($fileTmpName, $fileDestination);
						echo "Upload Success";
					} else {
						echo "<h1>File is too big</h1><br>"
							."Please, upload files smaller 5mb";
				}

				} else {
					echo "<h1>Error during uploading file</h1><br>"
						."Please, try again";
				}

			} else {
				echo "<h1>Forbidden file extension</h1><br>"
					."Allowed: <i>jpg, jpeg, png</i>";
			}
		}
	}

	// select an image to superpose


	// get image and save it into dir 'photos'

	// or upload image into dir 'photos'

	// show taken/uploaded photo with superposed image

}