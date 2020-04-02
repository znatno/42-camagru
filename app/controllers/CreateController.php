<?php


namespace app\controllers;

use app\core\Controller;

class CreateController extends Controller {

	public function newPostAction() {
		$prev_pics = $this->model->getPreviousTakenImgs();
		$this->view->render('New Post', ['prev_pics' => $prev_pics]);
	}

	public function uploadFileAction() {
		if (isset($_POST['image']) && isset($_POST['maskFilename'])) {
			$img_base64 = $_POST['image'];
			$mask_filename = $_POST['maskFilename'];

			if ($this->model->createImage($img_base64, $mask_filename)) {
				$this->view->message("Success", "Image is saved");
			}
			$this->view->message("Error", (isset($this->model->error) ? $this->model->error : "Please, try again"));
		}
		$this->view->message("Error", "No submitted data");
	}

	public function removeImageAction() {
		if (isset($_POST['path'])) {
			$path = $_POST['path'];

			if ($this->model->removeImage($path)) {
				$this->view->message("Success", "Image has been deleted");
			}
			$this->view->message("Error", "Image is already deleted. Please, reload this page");
		}
		$this->view->message("Error", "No submitted data");
	}

}