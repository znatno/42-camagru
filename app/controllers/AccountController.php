<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller {

	// todo: AJAXify [Log in / out]

	public function loginAction() {
		if (!empty($_POST)) {

			// todo: create model method

			$username = $_POST['username'];
			$password = hash('whirlpool', $_POST['password']);

			if (!$this->model->checkUser($username, $password)) {
				$this->view->message('error', $this->model->error);
			} else {
				$user = $this->model->db->row(
					'SELECT * FROM db_ibohun.users WHERE username = :username AND password = :password',
					['username' => $username, 'password' => $password]);

				$_SESSION['user'] = [
					'id' => $user[0]['id'],
					'username' => $user[0]['username'],
					'email' => $user[0]['email'],
					'confirm' => $user[0]['confirm']
				];
			}
			$this->view->redirect('/');
		}
		$this->view->render('Login');
	}

	public function logoutAction() {
		unset($_SESSION['user']);
		session_destroy();
		$this->view->redirect('/');
	}

	public function registerAction() {
		if (!empty($_POST)) {
			if (!$this->model->validate(['username', 'email', 'password'], $_POST)) {
				// Showing Error message, no Sign Up
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
			debug($_POST);
			debug($_SESSION);
		}
	}

	public function activateAction() {
		if (!empty($_GET)) {

			// todo: create activation

		}
	}


}