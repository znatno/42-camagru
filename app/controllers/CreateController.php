<?php


namespace app\controllers;

use app\core\Controller;

class CreateController extends Controller {

	public function newPostAction() {
		$this->view->render('New Post', []);
	}

	// Upload to the /pub/photos
	public function uploadFileAction() {
		if (isset($_POST['image'])) {
			$imgBase64 = $_POST['image'];

			$imgBase64 = str_replace('data:image/png;base64,', '', $imgBase64);
			$imgBase64 = str_replace(' ', '+', $imgBase64);
			$imgData = base64_decode($imgBase64);
			$fileName = uniqid() . '.png';
			$filePath = 'pub/photos/' . $fileName;
			$success = file_put_contents($filePath, $imgData);

			if ($success !== false) {
				$this->view->message("Success", "done: ");
			} else {
				$this->view->message("Error", "bad");
			}
		} else {
			$this->view->message("Error", "No submit ");
		}


	}




	// select an image to superpose

	// show taken/uploaded photo with superposed image

}