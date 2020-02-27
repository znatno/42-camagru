<?php

namespace app\lib;

use PDO;

class Db {

	protected $db;

	public function __construct() {
		$config = require 'app/config/db.php';
		$this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].'', $config['user'], $config['password']);
	}

	public function query($sql, $params = []) {
		$stmt = $this->db->prepare($sql);

		if (!empty($params)) {
			foreach ($params as $key => $val) {
				$stmt->bindValue(':'.$key, $val);
			}
		}
		$stmt->execute();

		//$query = $this->db->query($sql);

		return $stmt;
	}

	public function row($sql, $params = []) {
		$res = $this->query($sql, $params);
		return $res->fetchAll(PDO::FETCH_ASSOC);
	}

	public function column($sql, $params = []) {
		$res = $this->query($sql, $params);
		return $res->fetchColumn();
	}

}