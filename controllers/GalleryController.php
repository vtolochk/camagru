<?php

include_once ROOT . '/models/User.php';
include_once ROOT . '/models/Photos.php';

class GalleryController {
	public function actionIndex() {

		// get all images from the base
		$allPhotos = Photos::getAllPhotos();
		require_once(ROOT . '/views/gallery.php');
		return true;
	}
}