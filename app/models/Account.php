<?php


namespace app\models;

use app\core\Model;


class Account extends Model {

	public function validateRegistrationData($post) {
		return $this->validateUsername($post['username'])
			&& $this->validateEmail($post['email'])
			&& $this->validatePassword($post['password']);
	}

	public function validateUsername($username) {
		$pattern = '/^[A-Za-z0-9]{3,24}$/';
		if (!isset($username) || empty($username) || !preg_match($pattern, $username)) {
			$this->error = 'Username can consist only numbers and latin letters (from 3 to 24 symbols)';
			return false;
		}
		$stmt = $this->db->query('SELECT username FROM db_ibohun.users WHERE username = :username', ['username' => $username]);
		if ($stmt->rowCount() > 0) {
			$this->error = 'User exist';
			return false;
		}
		$this->error = 'User does not exist';
		return true;
	}

	public function validateEmail($email) {
		$pattern = '/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/';
		if (!isset($email) || empty($email) || !preg_match($pattern, $email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->error = 'Invalid email address';
			return false;
		}
		$stmt = $this->db->query('SELECT email FROM db_ibohun.users WHERE email = :email', ['email' => $email]);
		if ($stmt->rowCount() > 0) {
			$this->error = 'Email is already in use';
			return false;
		}
		$this->error = 'User with such email is not found';
		return true;
	}

	public function validatePassword($password) {
		$pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/';
		if (!isset($password) || empty($password) || !preg_match($pattern, $password)) {
			$this->error = 'Password must consist at least 1 lowercase and 1 uppercase letters, 1 number, 1 special symbol, and be 8 characters or longer';
			return false;
		}
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
			$this->error = 'Account isn\'t confirmed. Please, check your email for conformational link. After confirming try again';
			return false;
		}
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
		if (!$this->validatePassword($password)) {
			return false;
		}
		$password = hash('whirlpool', $password);
		$this->db->query('UPDATE db_ibohun.users SET password = :password WHERE email = :email;', ['password' => $password, 'email' => $email]);
		return true;
	}

	public function updateUserProfile($changed = []) {
		$id = $_SESSION['user']['id'];

		if (isset($changed['username']) && !empty($changed['username'])) {
			$this->db->query('UPDATE db_ibohun.users SET username = :username WHERE id = :id;', ['username' => $changed['username'], 'id' => $id]);
			$_SESSION['user']['username'] = $changed['username'];
		}
		if (isset($changed['email']) && !empty($changed['email'])) {
			$this->db->query('UPDATE db_ibohun.users SET email = :email WHERE id = :id;', ['email' => $changed['email'], 'id' => $id]);
			$_SESSION['user']['email'] = $changed['email'];
		}
		if (isset($changed['password']) && !empty($changed['password'])) {
			$password = hash('whirlpool', $changed['password']);
			$this->db->query('UPDATE db_ibohun.users SET password = :password WHERE id = :id;', ['password' => $password, 'id' => $id]);
		}
	}

}