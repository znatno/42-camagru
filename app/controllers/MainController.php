<?php


namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

class MainController extends Controller{

	public function indexAction() {

		$db = new Db;

		//$form = '2; '

		/*
		$params = [
			'id' => 3,
		];

		$data = $db->column('SELECT name FROM users WHERE id = :id', $params);
		debug($data);
		*/

		$this->view->render('Main Page');
	}

}