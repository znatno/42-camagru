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
		return true;
	}

}