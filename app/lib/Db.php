<?php

namespace app\lib;

use PDO;

class Db {

	protected $db;

	public function __construct() {
		$this->db = require 'app/config/setup.php';
	}

	public function isConnected() {
		if ($this->db instanceof PDO) {
			return 'DB is connected';
		} else {
			return 'DB does not exist';
		}
	}

	public function query($sql, $params = []) {
		$stmt = $this->db->prepare($sql);

		debug($params);
		if (!empty($params)) {
			foreach ($params as $key => $val) {
				if (is_int($val)) {
					$type = PDO::PARAM_INT;
				} else {
					$type = PDO::PARAM_STR;
				}
				debug(':'.$key);
				$stmt->bindValue(':'.$key, $val, $type);
			}
		}
		// debug($stmt);

		print_r($stmt);

		$stmt->execute();

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

	public function lastInsertId() {
		return $this->db->lastInsertId();
	}

}