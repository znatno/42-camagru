<?php


namespace app\controllers;

use app\core\Controller;

class CreateController extends Controller {

	public function newPostAction() {
		$this->view->render('New Post', []);
	}

	public function uploadFileAction() {

		if (isset($_POST['image']) && isset($_POST['maskId'])) {
			$imgBase64 = $_POST['image'];
			$maskId = $_POST['maskId'];

			if ($this->model->createImage($imgBase64, $maskId)) {
				$this->view->message("Success", "Image is saved");
			} else {
				$this->view->message("Error", (isset($this->model->error) ? $this->model->error : "Please, try again"));
			}
		} else {
			$this->view->message("Error", "No submitted data");
		}
	}

}