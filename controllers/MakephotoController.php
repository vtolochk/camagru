<?php

include_once ROOT . '/models/Photos.php';

class MakephotoController {
	public function actionIndex() {
		require_once(ROOT . '/views/makephoto.php');
		return true;
	}

	public function savePhotoFromCamera($img, $file_name, $dir_name) {
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$img_file = base64_decode($img);
		if (!is_dir($dir_name)) {
			mkdir($dir_name);
		}
		$res = file_put_contents($dir_name . $file_name, $img_file);
	}

	public function applyFilterToPhoto($img, $filter) {
		if ($filter === 'grayscale(100%)') {
			imagefilter($img, IMG_FILTER_GRAYSCALE);
		} else if ($filter === 'sepia(100%)') {
			imagefilter($img, IMG_FILTER_GRAYSCALE);
			imagefilter($img, IMG_FILTER_BRIGHTNESS, -5);
			imagefilter($img, IMG_FILTER_COLORIZE, 60, 45, 0);  
		} else if ($filter === 'invert(100%)') {
			imagefilter($img, IMG_FILTER_NEGATE);
		}
		else if ($filter === 'contrast(200%)') {
			imagefilter($img, IMG_FILTER_CONTRAST, -50);
		}
	}

	public function applySticker($final_image, $sticker) {
		// creating full path to sticker
		$stickerPath = explode('/', $sticker);
		$stickerPath = ROOT . '/' . $stickerPath[3] . '/' . $stickerPath[4];

		if (is_file($stickerPath) && is_readable($stickerPath)) {
				
			// create new image from sticker
			$stickerImg = imagecreatefrompng($stickerPath);

			// $stickerImg = imagescale($stickerImg, 175, 175);
			$size = getimagesize($stickerPath);
			imagecopy($final_image, $stickerImg, 0, 0, -65, -120, 600, 450);

			// clean image
			imagedestroy($stickerImg);
		}
	}

	public function actionSavePhoto() {
		if (isset($_SESSION['user_id'])) {

			// setting directory for saving photos and randomizer for names
			$dir_name = 'photos/';
			$file_name = date('Y_m_d') . '_' . rand(1, 10000) . '.png';

			// save simple image 
			MakephotoController::savePhotoFromCamera($_POST['img'], $file_name, $dir_name);

			// create new image to apply stickers and filters
			$final_image = imagecreatefrompng($dir_name . $file_name);
			imagesavealpha($final_image, true);
			imagealphablending($final_image, true);

			// apply filter to photo
			MakephotoController::applyFilterToPhoto($final_image, $_POST['filter']);

			// apply stickers and filters
			if (isset($_POST['sticker'])) {
				MakephotoController::applySticker($final_image, $_POST['sticker']);
			}

			// save changed image
			imagepng($final_image,  $dir_name . $file_name);
			Photos::addNewPhoto($dir_name . $file_name, $_SESSION['user_id']);

			// clean image
			imagedestroy($final_image);

			// sending path for javascript img tag
			$res = ['path' => $dir_name . $file_name];
			echo json_encode($res);
		}
		return true;
	}

	public function actionUploadPhoto () {
		if (isset($_SESSION['user_id'])) {
			$dir_name = 'photos/';
			$file_name = date('Y_m_d') . '_' . rand(1, 10000) . '.png';
			$upload_file_name = $dir_name . $file_name;
			if (isset($_FILES['file'])) {
				if ($_FILES['file']['size'] != 0 and $_FILES['file']['size'] <= 10240000) {
					move_uploaded_file($_FILES['file']['tmp_name'], $upload_file_name);

					// add file to data base
					Photos::addNewPhoto($upload_file_name, $_SESSION['user_id']);

					// return path to the file and show in the browser
					echo 'success';
				}
		}
		return true;
	}
}

}