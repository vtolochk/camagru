<?php

class Database
{
	public static function getConnection () {
		$paramsPath = ROOT . '/config/db_params.php';
		$params = include($paramsPath);
		$dsn = 'mysql:host=' . $params['host'] . ';dbname=' . $params['dbname'];
		$pdo = new PDO ($dsn, $params['user'], $params['password']);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;
	}
}