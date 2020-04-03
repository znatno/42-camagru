<?php


namespace app\controllers;

use app\core\Controller;

class MainController extends Controller {

	public function indexAction() {

		$photos = $this->model->getPhotos();

		$vars = [
			'photos' => $photos,
		];

		$this->view->render('Main Page', $vars);
	}

	public function changeLikeAction() {

		if (isset($_POST['photoId']) && isset($_POST['action'])) {
			if ($_POST['action'] == 'like') {
				if ($this->model->likePhoto($_POST['photoId'])) {
					$this->view->message('Success', 'Post is liked');
				}
				$this->view->message('Error', $this->model->error);
			} elseif ($_POST['action'] == 'dislike') {
				if ($this->model->dislikePhoto($_POST['photoId'])) {
					$this->view->message('Success', 'Post is disliked');
				}
				$this->view->message('Error', $this->model->error);
			}
			$this->view->message('Error', 'Something went wrong. Contact administrator');
		}
		$this->view->message('Error', 'Post is not found');
	}

}