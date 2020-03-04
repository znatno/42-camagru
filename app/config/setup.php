<?php
	include_once 'database.php';

	try {
		$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}

	return $dbh;