<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller {

	// todo: AJAXify [Log in / out]
	public function loginAction() {
		if (!empty($_POST)) {
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
				// Getting POST values
				$id = 0;
				$username = $_POST['username'];
				$email = $_POST['email'];
				$password = hash('whirlpool', $_POST['password']);
				$confirm = 0;

				// Adding into Db
				$this->model->db->query(
					'INSERT INTO `users` (id, username, email, password, confirm) VALUE (:id, :username, :email, :password, :confirm)',
					['id' => $id, 'username' => $username, 'email' => $email, 'password' => $password, 'confirm' => $confirm]);

				// Showing result after Sign Up
				$this->view->message('success', 'You are registered. Check your email for confirmation');
			}
		}
		$this->view->render('Register');
	}

	public function forgotAction() {
		$this->view->render('Forgot Password');
	}

	public function confirmAction() {
		$this->view->render('Confirm');
	}


}