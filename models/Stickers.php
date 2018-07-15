<?php

class Stickers
{
	public static function getStickers() {
		//work with data bases
		$test = Db::getConnection();
		return $test;
	}
}