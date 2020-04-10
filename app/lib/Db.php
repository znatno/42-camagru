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

		// TODO: rm this
		$this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

		$stmt = $this->db->prepare($sql);
		if (!empty($params)) {
			foreach ($params as $key => $val) {
				if (is_int($val)) {
					$type = PDO::PARAM_INT;
				} elseif (is_bool($val)) {
					$type = PDO::PARAM_BOOL;
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

	public function columnAllOccurs($sql, $params = []) {
		$arr = [];
		$res = $this->query($sql, $params);
		while ($data = $res->fetchColumn()) {
			$arr[] = $data;
		}
		return $arr;
	}

	public function lastInsertId() {
		return $this->db->lastInsertId();
	}

}