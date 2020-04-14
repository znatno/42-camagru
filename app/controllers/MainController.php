<?php


namespace app\controllers;

use app\core\Controller;

class MainController extends Controller {

	public function indexAction() {

		$nb_posts = $this->model->db->column('SELECT COUNT(*) FROM db_ibohun.photos');
		$nb_pages = ceil($nb_posts / 5);

		if (isset($_GET['page'])) {
			$page = (int) $_GET['page'];
		}
		if (!isset($page) || $nb_pages < $page || $page < 1) {
			$page = 1;
		}

		$photos_arr = $this->model->getPhotos($page);
		$this->view->render('Main Page', ['photos_arr' => $photos_arr, 'nb_pages' => $nb_pages]);
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
				$this->view->message('Error', 'Something went wrong. Contact administrator. Err: '.$this->model->error);
			}
			$this->view->message('Error', 'Comment is empty');
		}
	}

	public function delCommentAction() {
		if (isset($_POST['photoId']) && isset($_POST['timestamp']) && isset($_POST['username'])) {
			if ($this->model->delComment($_POST['photoId'], $_POST['timestamp'], $_POST['username'])) {
				$this->view->message('Success', 'Comment have been delete');
			}
			$this->view->message('Error', 'Something went wrong. Contact administrator');
		}
	}

}