<?php


namespace app\models;

use app\core\Model;


class Account extends Model {

	public function validateRegistrationData($input, $post) {
		$rules = [
			'username' => [
				 'pattern' => '/[A-Za-z0-9]{3,15}$/',
				'message' => 'Username can consist only numbers and latin letters (min. 3 symbols)',
			],
			'email' => [
				'pattern' => '/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/',
				'message' => 'Invalid email address',
			],
			'password' => [
				'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/',
				'message' => 'Password must consist at least 1 lowercase and 1 uppercase letters, 1 number, 1 special symbol, and be 8 characters or longer',
			],
		];
		foreach ($input as $val) {
			if (!isset($post[$val]) || empty($post[$val]) || !preg_match($rules[$val]['pattern'], $post[$val])) {
				$this->error = $rules[$val]['message'];
				return false;
			}
		}
		if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error = $rules['email']['message'];
			return false;
		}
		$stmt = $this->db->query('SELECT username FROM db_ibohun.users WHERE username = :username', ['username' => $post['username']]);
		if ($stmt->rowCount() > 0) {
			$this->error = 'Username exists';
			return false;
		}
		$stmt = $this->db->query('SELECT email FROM db_ibohun.users WHERE email = :email', ['email' => $post['email']]);
		if ($stmt->rowCount() > 0) {
			$this->error = 'Email is already in use';
			return false;
		}
		return true;
	}

	public function checkUsername($username) {
		$stmt = $this->db->query('SELECT username FROM db_ibohun.users WHERE username = :username', ['username' => $username]);
		if ($stmt->rowCount() == 0) {
			$this->error = 'User does not exist';
			return false;
		}
		$this->error = 'User exist';
		return true;
	}

	public function checkUserPassword($user, $pass) {
		$stmt = $this->db->query('SELECT username FROM db_ibohun.users WHERE username = :username', ['username' => $user]);
		if ($stmt->rowCount() == 0) {
			$this->error = 'User does not exist';
			return false;
		}
		$stmt = $this->db->query('SELECT username FROM db_ibohun.users WHERE username = :username AND password = :password', ['username' => $user, 'password' => $pass]);
		if ($stmt->rowCount() != 1) {
			$this->error = 'Wrong password';
			return false;
		}
		$stmt = $this->db->query('SELECT username FROM db_ibohun.users WHERE username = :username AND confirmed = :confirm', ['username' => $user, 'confirm' => true]);
		if ($stmt->rowCount() != 1) {
			$this->error = 'Account isn\'t confirmed. Please, check your email for confirmational link. After confirming try again';
			return false;
		}
		return true;
	}

	public function checkEmail($email) {
		$stmt = $this->db->query('SELECT email FROM db_ibohun.users WHERE email = :email', ['email' => $email]);
		if ($stmt->rowCount() > 0) {
			$this->error = 'Email is already in use';
			return false;
		}
		$this->error = 'User with such email is not found';
		return true;
	}

	public function createUser($username, $email, $password) {
		$id = 0;
		$confirm = 0;
		$password = hash('whirlpool', $password);

		$this->db->query(
			'INSERT INTO `db_ibohun`.`users` (id, username, email, password, confirmed) VALUE (:id, :username, :email, :password, :confirm)',
			['id' => $id, 'username' => $username, 'email' => $email, 'password' => $password, 'confirm' => $confirm]);
	}

	public function logInUser($username, $password) {
		$user = $this->db->row(
			'SELECT * FROM db_ibohun.users WHERE username = :username AND password = :password',
			['username' => $username, 'password' => $password]);

		$_SESSION['user'] = [
			'id' => $user[0]['id'],
			'username' => $user[0]['username'],
			'email' => $user[0]['email'],
			'confirm' => $user[0]['confirm']
		];
	}

	public function logInUserByEmail($email) {
		$user = $this->db->row(
			'SELECT * FROM db_ibohun.users WHERE email = :email',
			['email' => $email]);

		$_SESSION['user'] = [
			'id' => $user[0]['id'],
			'username' => $user[0]['username'],
			'email' => $user[0]['email'],
			'confirm' => $user[0]['confirm']
		];
	}

	public function logOutUser() {
		unset($_SESSION['user']);
		session_destroy();
	}

	public function getSecret($var) {
		$salt = 'Boritesia-Poborete!';
		return hash('md5', $var . $salt);
	}

	public function sendConfirmEmail($email) {
		$title = '42 Camagru: Sign Up Confirmation';

		$secret = $this->getSecret($email);
		$port = $_SERVER['SERVER_PORT'];
		$host = $_SERVER['HTTP_HOST'];
		$link = "http://$host:$port/account/activate?email=$email&secret=$secret";
		$message = wordwrap("Please, click on the following link to confirm your registration:\r\n\r\n <a href=\"$link\">$link</a>");

		require 'app/lib/mail.php';
		sendMail($email, $title, $message);
	}

	public function confirmEmail($email) {
		$secret = $this->getSecret($email);
		if ($secret == $_GET['secret']) {
			$this->db->query('UPDATE db_ibohun.users SET confirmed = 1 WHERE email = :email;', ['email' => $email]);
		}
	}

	public function checkIsEmailConfirmed($email) {
		return $this->db->column('SELECT confirmed FROM db_ibohun.users WHERE email = :email', ['email' => $email]);
	}

	public function sendResetEmail($email) {
		$title = '42 Camagru: Reset Password';

		$secret = $this->getSecret('reset' . $email . 'password');
		$port = $_SERVER['SERVER_PORT'];
		$host = $_SERVER['HTTP_HOST'];
		$link = "http://$host:$port/account/reset-password?email=$email&secret=$secret";
		$message = wordwrap("Please, click on the following link to reset your password:\r\n\r\n <a href=\"$link\">$link</a>");

		require 'app/lib/mail.php';
		sendMail($email, $title, $message);
	}

	public function validateAndSetPassword($password, $email) {
		$pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/';
		$msg = 'Password must consist at least 1 lowercase and 1 uppercase letters, 1 number, 1 special symbol, and be 8 characters or longer';
		if (!isset($password) || empty($password) || !preg_match($pattern, $password) || !isset($email) || empty($email)) {
			$this->error = $msg;
			return false;
		}
		$this->db->query('UPDATE db_ibohun.users SET password = :password WHERE email = :email;', ['password' => $password, 'email' => $email]);
		return true;
	}

}