<?php


namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

class MainController extends Controller{

	public function indexAction() {

		$db = new Db;
		$data = $db->row('SELECT name FROM users');
		//debug($data);

		$this->view->render('Main Page');
	}

}