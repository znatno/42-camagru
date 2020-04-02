<?php


namespace app\models;

use app\core\model;

class Create extends Model {

	public function createImage($imgBase64, $maskFilename) {

		if (empty($maskFilename)) {
			$this->error = 'No mask selected';
			return false;
		}

		// Base64 to Image
		$imgBase64 = str_replace('data:image/png;base64,', '', $imgBase64);
		$imgBase64 = str_replace(' ', '+', $imgBase64);
		$imgData = base64_decode($imgBase64);

		// Creating image
		$src = imagecreatefrompng('pub/res/masks/src/' . $maskFilename . '.png');
		$dest = imageCreateFromString($imgData);
		imagecopy($dest, $src, 0, 0, 0, 0, 640, 480); //have to play with these numbers for it to work for you, etc.
		header('Content-Type: image/png');
		$fileName = uniqid('', true) . '.png';
		$path = 'pub/photos/' . $fileName;
		$status = imagepng($dest, $path);
		imagedestroy($dest);
		imagedestroy($src);

		// TODO: add photo to DB

		return $status;
	}
}