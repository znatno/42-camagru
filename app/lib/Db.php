<?php

namespace app\lib;

use PDO;

class Db {

	protected $db;

	public function __construct() {
		$this->db = require 'app/config/setup.php';
	}

	public function query($sql, $params = []) {
		$stmt = $this->db->prepare($sql);

		if (!empty($params)) {
			foreach ($params as $key => $val) {
				if (is_int($val)) {
					$type = PDO::PARAM_INT;
				} else {
					$type = PDO::PARAM_STR;
				}
				$stmt->bindValue(':'.$key, $val, $type);
			}
		}
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