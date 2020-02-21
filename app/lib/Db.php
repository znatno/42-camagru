<?php

namespace app\lib;

use PDO;

class Db {

	protected $db;

	public function __construct() {
		$config = require 'app/config/db.php';
		$this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].'', $config['user'], $config['password']);
	}

	public function query($sql) {
		$query = $this->db->query($sql);
		return $query;
	}

	public function row($sql) {
		$res = $this->query($sql);
		return $res->fetchAll();
	}

	public function column($sql) {
		$res = $this->query($sql);
		return $res->fetchColumn();
	}

}