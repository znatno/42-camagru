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
		$dest = imagecreatefromstring($img_data);
		if ($mask_filename != "no") {
			$src = imagecreatefrompng('pub/res/masks/src/' . $mask_filename . '.png');
			imagecopy($dest, $src, 0, 0, 0, 0, 640, 480);
		}
		header('Content-Type: image/png');
		$filename = uniqid('', true) . '.png';
		$path = 'pub/photos/' . $filename;

		// Saving to path
		$status = imagepng($dest, $path);
		imagedestroy($dest);
		if ($mask_filename != "no") {
			imagedestroy($src);
		}

		// Saving to Database
		if ($status) {
			$sql = 'INSERT INTO db_ibohun.photos (id, username, user_id, path, timestamp)
				VALUES (:id, :username, :user_id, :path, :timestamp)';
			$params = [
				'id' => 0,
				'username' => $_SESSION['user']['username'],
				'user_id' => $_SESSION['user']['id'],
				'path' => $path,
				'timestamp' => date('Y-m-d H:i:s'),
			];
			$this->db->query($sql, $params);
		} else {
			$this->error = 'Error during saving. Please, try again';
		}
		// Return success or error
		return $status;
	}

	public function getPreviousTakenImgs() {

		$res = $this->db->columnAllOccurs(
			'SELECT path FROM db_ibohun.photos WHERE user_id = :user_id ORDER BY id DESC',
			['user_id' => $_SESSION['user']['id']]
		);

		if ($res) {
			$prev_pics = "";
			$pic_id = 0;

			foreach ($res as $path) {
				$pic_id++;
				$prev_pics .=
					"<div class='col-lg-12 mb-4 p-0' id='prev-img-{$pic_id}'>".
					"<img class='img-thumbnail' src='/{$path}' alt='Not found: {$path}' onclick='removeImage(this.getAttribute(\"src\"));'>".
					"</div>";
			}
			return $prev_pics;
		}
		return "No images had taken yet";
	}

	public function removeImage($path) {

		if (file_exists($path)) {
			unlink($path);
			$this->db->query('DELETE FROM db_ibohun.photos WHERE path = :img_path', ['img_path' => $path]);
			return true;
		}
		return false;
	}

}