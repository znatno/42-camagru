<?php


namespace app\models;

use app\core\Model;


class Account extends Model {

	public function validate($input, $post) {
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
			if (!isset($post[$val]) or empty($post[$val]) or !preg_match($rules[$val]['pattern'], $post[$val])) {
				$this->error = $rules[$val]['message'];
				return false;
			}
		}
		if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error = $rules['email']['message'];
			return false;
		}

		$stmt = $this->db->query(
			'SELECT username FROM db_ibohun.users WHERE username = :username', ['username' => $post['username']]);
		if ($stmt->rowCount() > 0) {
			$this->error = 'Username exists';
			return false;
		}

		$stmt = $this->db->query(
			'SELECT email FROM db_ibohun.users WHERE email = :email', ['email' => $post['email']]);
		if ($stmt->rowCount() > 0) {
			$this->error = 'Email is already in use';
			return false;
		}

		return true;
	}

	public function checkUser($user, $pass) {

		$stmt = $this->db->query(
			'SELECT username FROM db_ibohun.users WHERE username = :username', ['username' => $user]);
		if ($stmt->rowCount() == 0) {
			$this->error = 'User does not exist';
			return false;
		}

		$stmt = $this->db->query(
			'SELECT username FROM db_ibohun.users WHERE username = :username AND password = :password', ['username' => $user, 'password' => $pass]);
		if ($stmt->rowCount() != 1) {
			$this->error = 'Wrong password';
			return false;
		}

		return true;
	}

	public function createUser($username, $email, $password) {
		$id = 0;
		$confirm = 0;
		$password = hash('whirlpool', $password);

		$this->db->query(
			'INSERT INTO `db_ibohun`.`users` (id, username, email, password, confirm) VALUE (:id, :username, :email, :password, :confirm)',
			['id' => $id, 'username' => $username, 'email' => $email, 'password' => $password, 'confirm' => $confirm]);

	}

	public function sendConfirmEmail($email) {
		$title = '42 Camagru: Sign Up Confirmation';

		$secret = $this->getSecret($email);
		$port = $_SERVER['SERVER_PORT'];
		$host = $_SERVER['HTTP_HOST'];
		$link = "http://$host:$port/account/activate?email=$email&secret=$secret";
		$message = "Please, click on the following link to confirm your registration:\r\n\r\n$link";

		sendMail($email, $title, $message);
	}

	public function getSecret($var) {
		$salt = 'Boritesia-Poborete!';
		return hash('whirlpool', $var . $salt);
	}

}