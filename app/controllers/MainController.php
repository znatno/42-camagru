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

	public function addCommentAction() {

		if (isset($_POST['photoId']) && isset($_POST['text'])) {
			if (!empty($_POST['text'])) {
				if ($this->model->addComment($_POST['photoId'], $_POST['text'])) {
					$this->view->message('Success', 'Photo have been commented');
				}
				$this->view->message('Error', 'Something went wrong. Contact administrator');
			}
			$this->view->message('Error', 'Comment is empty');
		}
	}

	public function delCommentAction() {

		if (isset($_POST['photoId']) && isset($_POST['timestamp']) && isset($_POST['username'])) {
			if ($this->model->delComment($_POST['photoId'], $_POST['text'])) {
				$this->view->message('Success', 'Comment have been delete');
			}
			$this->view->message('Error', 'Something went wrong. Contact administrator');
		}
	}

}