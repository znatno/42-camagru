<?php


namespace app\controllers;

use app\core\Controller;

class MainController extends Controller {

	public function indexAction() {

//		$news = $this->model->getNews();
//		$vars = [
//			'news' => $news,
//		];
//		$this->view->render('Main Page', $vars);
		$this->view->render('Main Page');
	}

}