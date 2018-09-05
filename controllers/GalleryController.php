<?php

include_once ROOT . '/models/User.php';

class GalleryController {
	public function actionIndex() {
		require_once(ROOT . '/views/gallery.php');
		return true;
	}
}