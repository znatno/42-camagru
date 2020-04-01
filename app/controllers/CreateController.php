<?php


namespace app\controllers;

use app\core\Controller;

class CreateController extends Controller {

	public function newPostAction() {
		$this->view->render('New Post', []);
	}

	public function uploadFileAction() {

		if (isset($_POST['image']) && isset($_POST['maskFilename'])) {
			$imgBase64 = $_POST['image'];
			$maskFilename = $_POST['maskFilename'];

			if ($this->model->createImage($imgBase64, $maskFilename)) {
				$this->view->message("Success", "Image is saved");
			} else {
				$this->view->message("Error", (isset($this->model->error) ? $this->model->error : "Please, try again"));
			}
		} else {
			$this->view->message("Error", "No submitted data");
		}
	}

}