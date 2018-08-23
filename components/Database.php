<?php

class Database
{
	public static function getConnection () {
		$paramsPath = ROOT . '/config/db_params.php';
		$params = include($paramsPath);
		$dsn = 'mysql:host=' . $params['host'] . ';dbname=' . $params['dbname'];
		$pdo = new PDO ($dsn, $params['user'], $params['password']);
		$stmt = $pdo->query('SELECT * FROM users');
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $res[0];
	}

	public function verify_email ($table, $email) {

	}

	public function insert_record ($table, $input) {

	}

	public function send_activation_code ($email, $act_code) {
		
	}
}