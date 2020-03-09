<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller {

	public function loginAction() {
		if (!empty($_POST)) {
			$this->view->location('/');

		}
		$this->view->render('Login');
	}

	public function registerAction() {
		if (!empty($_POST)) {
			if (!$this->model->validate(['username', 'email', 'password'], $_POST)) {
				$this->view->message('error', $this->model->error);
			}

		}
		$this->view->render('Register');
	}

	public function forgotAction() {
		$this->view->render('Forgot Password');
	}


}