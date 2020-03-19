<?php

namespace app\controllers;

use app\core\Controller;
use app\core\View;

class AccountController extends Controller {

	public function loginAction() {
		if (!empty($_POST)) {
			$username = $_POST['username'];
			$password = hash('whirlpool', $_POST['password']);

			if (!$this->model->checkUserPassword($username, $password)) {
				$this->view->message('error', $this->model->error);
			} else {
				$this->model->logInUser($username, $password);
				$this->view->location('/');
			}
		}
		$this->view->render('Login');
	}

	public function logoutAction() {
		$this->model->logOutUser();
		$this->view->redirect('/');
	}

	public function registerAction() {
		if (!empty($_POST)) {
			if (!$this->model->validateRegistrationData(['username', 'email', 'password'], $_POST)) {
				$this->view->message('error', $this->model->error);
			} else {
				$this->model->createUser($_POST['username'], $_POST['email'], $_POST['password']);
				$this->view->message('success', 'Check your email for confirmation to continue your registration');
			}
		}
		$this->view->render('Register');
	}

	public function forgotAction() {

		// todo: create forgot password

		$this->view->render('Forgot Password');
	}

	public function confirmAction() {
		if (!empty($_POST)) {
			require 'app/lib/mail.php';

			$this->model->sendConfirmEmail($_POST['email']);
			$this->view->render('Confirm');
		} else {
			View::errorCode(400);
		}
	}

	public function activateAction() {
		$email = $_GET['email'];

		if ($email && !$this->model->checkIsEmailConfirmed($email)) {
			$this->model->confirmEmail($email);
			$this->view->redirect('/account/login');
		} else {
			View::errorCode(400);
		}

	}

}