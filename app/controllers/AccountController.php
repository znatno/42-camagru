<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller {

	public function loginAction() {
		if (!empty($_POST)) {
			$this->view->redirect('/');

		}
		$this->view->render('Login');
	}

	public function registerAction() {

		// todo: AJAXify [Sign Up]
		// поки що обходжуся провіркою впритик

		if (!empty($_POST)) {
			if (!$this->model->validate(['username', 'email', 'password'], $_POST)) {
				$this->view->message('error', $this->model->error);
				// $this->view->errorCode(400);

			}
			$this->view->message('success', 'form passed validation');
		}
		$this->view->render('Register');
	}

	public function forgotAction() {
		$this->view->render('Forgot Password');
	}


}