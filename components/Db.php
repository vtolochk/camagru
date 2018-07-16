<?php

class Db
{
	public static function getConnection() {
		$paramsPath = ROOT . '/config/db_params.php';
		$params = include($paramsPath);
		try {
			$dbInfo = "mysql:host = {$params['host']}; dbname = {$params['dbname']}";
			$connection = new PDO ($dbInfo, $params['user'], $params['password']);
			echo 'Connection successfull'; // temporary
		}
		catch (PDOException $e) {
			echo "Connection to data base failed: " . $e->getMessage();
		}
		$test = ['aaaaa', 'bbbbb', 'ccccc']; // temporary
		return $test;
	}
}