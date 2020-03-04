<?php


namespace app\controllers;

use app\core\Controller;

class CreateController extends Controller {

	public function newAction() {

		$this->view->render('New Post', []);
	}

}