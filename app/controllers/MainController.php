<?php


namespace app\controllers;

use app\core\Controller;

class MainController extends Controller {

	public function indexAction() {

		$res = $this->model->getNews();
		$vars = [
			'news' => $res,
		];
		$this->view->render('Main Page', $vars);
	}

}