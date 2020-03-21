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
				$this->view->message('Error', $this->model->error);
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

	/*------- Sign Up Flow -------*/
	public function registerAction() {
		if (!empty($_POST)) {
			if (!$this->model->validateRegistrationData(['username', 'email', 'password'], $_POST)) {
				$this->view->message('Error', $this->model->error);
			} else {
				$this->model->createUser($_POST['username'], $_POST['email'], $_POST['password']);
				$this->view->message('Success', 'Check your email for confirmation to continue your registration');
			}
		}
		$this->view->render('Register');
	}

	public function confirmAction() {
		if (!empty($_POST)) {
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
	/*----------------------------*/

	/*------ Reset Password ------*/
	public function forgotAction() {
		if (!empty($_POST['email'])) {
			if (!$this->model->checkEmail($_POST['email'])) {
				$this->model->sendResetEmail($_POST['email']);
				$this->view->message('Success', 'Reset password email was sent');
			} else {
				$this->view->message('Error', $this->model->error);
			}
		}
		$this->view->render('Forgot Password');
	}

	public function forgotSentAction() {
		$this->view->render('Reset link was sent');
	}

	public function resetPasswordAction() {
		$email = $_GET['email'];
		$secret = $_GET['secret'];
		if ($email && !$this->model->checkEmail($email)) {
			if ($this->model->checkIsEmailConfirmed($email)) {
				if ($secret == $this->model->getSecret('reset'.$email.'password')) {
					setcookie("UserEmail", htmlspecialchars($email), time() + 3600);
					$this->view->render('Create New Password');
				} else {
					echo "<h3>Invalid secret key</h3>Contact email: support@camagru.com<br />";
					View::errorCode(400);
				}
			} else {
				echo "<h3>Email is not confirmed</h3>Please, confirm your email firstly.<br />";
				View::errorCode(401);
			}
		} else {
			echo "<h3>User with such does not exist</h3>Please, sign up firstly.<br />";
			View::errorCode(403);
		}
	}

	public function resetPasswordChangeAction() {
		$email = $_POST['email'];
		$password = $_POST['password'];

		if (!$this->model->validateAndSetPassword($password)) {
			$this->view->message('Error', $this->model->error);
		}
		// find user by email
		// set new passwd

		unset($_COOKIE['UserEmail']);
		$this->view->message('status', 'message');
	}

	public function resetPasswordDoneAction() {
		$this->view->render('Password has been changed');
	}
	/*----------------------------*/

	/*------- Profile Flow -------*/

	public function showProfileAction() {
		$this->view->render('Profile');
	}

	public function showProfileSaveChangesAction() {

		// перевірити чи були змінені поля
		// перевірити чи різняться значення полів

		$this->view->render('Profile');
	}

	/*----------------------------*/
}