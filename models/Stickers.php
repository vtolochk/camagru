<?php

class Stickers
{
	public static function getStickers() {
		//work with data bases
		$test = Database::getConnection();
		return $test;
	}
}