<?php

include_once ROOT . '/models/Photos.php';
include_once ROOT . '/models/Stickers.php';

class MakephotoController {
	public function actionIndex() {
		$stickers = Stickers::getStickers();
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

	public function actionSavePhoto() {
		if (isset($_SESSION['user_id'])) {
			// save image
			$dir_name = 'photos/';
			$file_name = date('Y_m_d') . '_' . rand(1, 10000) . '.png';
			MakephotoController::savePhotoFromCamera($_POST['img'], $file_name, $dir_name);

			// create new image with stickers
			$size = getimagesize('stickers/glasses.png');
			$sticker_width = $size[0];
			$sticker_height = $size[1];
			$size = getimagesize($dir_name . $file_name);
			$photo_width = $size[0];
			$photo_height = $size[1];
			$final_image = imagecreatetruecolor($photo_width, $photo_height);
			imagesavealpha($final_image, true);
			$sticker = imagecreatefrompng('stickers/glasses.png');
			$image = imagecreatefrompng($dir_name . $file_name);
			$sticker_width *= 0.2;
			$sticker_height *= 0.2;
			$sticker = imagescale($sticker, $sticker_width, $sticker_height);
			$transparentBg = imagecolorallocatealpha($sticker, 0, 127, 255, 127);
			imagefill($sticker, 0, 0, $transparentBg);
			imagecopy($final_image, $image, 0, 0, 0, 0, $photo_width, $photo_height);
			imagecopy($final_image, $sticker, 0, 0, 0, 0, $sticker_width, $sticker_height);
			
			// apply filters
			MakephotoController::applyFilterToPhoto($final_image, $_POST['filter']);
			// save image
			imagepng($final_image,  $dir_name . $file_name);
			Photos::addNewPhoto($dir_name . $file_name, $_SESSION['user_login']);
			// clean images
			imagedestroy($image);
			imagedestroy($sticker);
			// sending path for javascript img tag
			$res = ['path' => $dir_name . $file_name];
			echo json_encode($res);
		}
		return true;
	}

}