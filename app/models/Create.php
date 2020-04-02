<?php


namespace app\models;

use app\core\model;

class Create extends Model {

	public function createImage($img_base64, $mask_filename) {

		if (empty($mask_filename)) {
			$this->error = 'No mask selected';
			return false;
		}

		// Base64 to Image
		$img_base64 = str_replace('data:image/png;base64,', '', $img_base64);
		$img_base64 = str_replace(' ', '+', $img_base64);
		$img_data = base64_decode($img_base64);

		// Creating Image
		$src = imagecreatefrompng('pub/res/masks/src/' . $mask_filename . '.png');
		$dest = imagecreatefromstring($img_data);
		imagecopy($dest, $src, 0, 0, 0, 0, 640, 480); //have to play with these numbers for it to work for you, etc.
		header('Content-Type: image/png');
		$filename = uniqid('', true) . '.png';
		$path = 'pub/photos/' . $filename;
		$status = imagepng($dest, $path);
		imagedestroy($dest);
		imagedestroy($src);

		// Saving to Database
		if ($status) {
			$sql = 'INSERT INTO `db_ibohun`.`photos` (id, path, user_id, timestamp, likes, comments)
				VALUES (:id, :path, :user_id, :timestamp, :likes, :comments)';
			$params = [
				'id' => 0,
				'path' => $path,
				'user_id' => $_SESSION['user']['id'],
				'timestamp' => date('Y-m-d H:i:s'),
				'likes' => 0,
				'comments' => 0
			];
			$this->db->query($sql, $params);
		} else {
			$this->error = 'Error during saving. Please, try again';
		}

		// Return success or error
		return $status;
	}

}