<?php

include_once ROOT . '/models/Stickers.php';

class MakephotoController {
	public function actionIndex() {
		$stickers = Stickers::getStickers();
		require_once(ROOT . '/views/makephoto.php');
		return true;
	}
}