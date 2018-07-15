<?php

class Db
{
	public static function getConnection() {
		
		//all work with db here
		$paramsPath = ROOT . '/config/db_params.php';
		$params = include($paramsPath);
		$test = ['aaaaa', 'bbbbb', 'ccccc'];
		return $test;
	}
}