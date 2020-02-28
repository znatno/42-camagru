<?php


namespace app\controllers;

use app\core\Controller;

class MainController extends Controller {

	public function indexAction() {

		/*
		$params = [
			'id' => 3,
		];

		// output from Db
		$data = $db->column('SELECT name FROM users WHERE id = :id', $params);
		debug($data);
		*/

		$res = $this->model->getNews();
		$vars = [
			'news' => $res,
		];
		$this->view->render('Main Page', $vars);
	}

}