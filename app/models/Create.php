<?php


namespace app\models;

use app\core\model;

class Create extends Model {

	public function createImage($imgBase64, $maskId) {
		// Base64 to Image
		$imgBase64 = str_replace('data:image/png;base64,', '', $imgBase64);
		$imgBase64 = str_replace(' ', '+', $imgBase64);
		$imgData = base64_decode($imgBase64);

		// Get mask
		switch ($maskId) {
			case 1:
				$src = imagecreatefrompng('pub/res/masks/src/42.png');
				break;
			case 2:
				$src = imagecreatefrompng('pub/res/masks/src/anime.png');
				break;
			case 3:
				$src = imagecreatefrompng('pub/res/masks/src/brazzers.png');
				break;
			case 4:
				$src = imagecreatefrompng('pub/res/masks/src/covid.png');
				break;
			case 5:
				$src = imagecreatefrompng('pub/res/masks/src/cowboy.png');
				break;
			case 6:
				$src = imagecreatefrompng('pub/res/masks/src/gun.png');
				break;
			case 7:
				$src = imagecreatefrompng('pub/res/masks/src/jesus.png');
				break;
			case 8:
				$src = imagecreatefrompng('pub/res/masks/src/kitty.png');
				break;
			case 9:
				$src = imagecreatefrompng('pub/res/masks/src/mask.png');
				break;
			default:
				$this->error = 'No mask selected';
				return false;
		}

		// Creating image
		$dest = imageCreateFromString($imgData);
		imagecopy($dest, $src, 0, 0, 0, 0, 640, 480); //have to play with these numbers for it to work for you, etc.
		header('Content-Type: image/png');
		$fileName = uniqid('', true) . '.png';
		$status = imagepng($dest, 'pub/photos/'.$fileName);
		imagedestroy($dest);
		imagedestroy($src);

		return $status;
	}
}