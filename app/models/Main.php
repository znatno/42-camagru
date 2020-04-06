<?php

namespace app\models;

use app\core\Model;

class Main extends Model {

	public function getPhotos() {

		$photos = $this->db->row(
			'SELECT id, path, username, timestamp, likes, comments FROM db_ibohun.photos ORDER BY id DESC'
		);

		if (isset($_SESSION['user'])) {
			$user_likes = $this->db->columnAllOccurs(
				'SELECT photo_id FROM db_ibohun.likes WHERE user_id = :user_id', ['user_id' => $_SESSION['user']['id']]
			);
			foreach ($photos as $key => $photo) {
				$photos[$key]['liked'] = in_array($photo['id'], $user_likes) ? 'fa-heart' : 'fa-heart-o';

				// TODO: check for comments and assign to array

			}
		}

		return $photos;
	}

	public function likePhoto($photo_id) {

		if ($this->checkUserPhotoExistance($photo_id)) {
			$sql_add_like = 'INSERT INTO db_ibohun.likes (photo_id, user_id) VALUES (:photo_id, :user_id)';
			$sql_inc_like = 'UPDATE db_ibohun.photos SET likes = likes + 1 WHERE id = :id';

			return $this->db->query($sql_add_like, ['photo_id' => $photo_id, 'user_id' => $_SESSION['user']['id']])
				&& $this->db->query($sql_inc_like, ['id' => $photo_id]);
		}
		$this->error .= ' Error during liking photo';
		return false;
	}

	public function dislikePhoto($photo_id) {

		if ($this->checkUserPhotoExistance($photo_id)) {
			$sql_rem_like = 'DELETE FROM db_ibohun.likes photo_id WHERE photo_id = :photo_id AND user_id = :user_id';
			$sql_dec_like = 'UPDATE db_ibohun.photos SET likes = likes - 1 WHERE id = :id';

			return $this->db->query($sql_rem_like, ['photo_id' => $photo_id, 'user_id' => $_SESSION['user']['id']])
				&& $this->db->query($sql_dec_like, ['id' => $photo_id]);
		}
		$this->error .= ' Error during disliking photo';
		return false;
	}

	public function checkUserPhotoExistance($photo_id) {

		if ($this->db->column('SELECT id FROM db_ibohun.users WHERE id = :id AND confirmed = :confirmed',
				['id' => $_SESSION['user']['id'], 'confirmed' => $_SESSION['user']['confirmed']])
			&& $this->db->column('SELECT id FROM db_ibohun.photos WHERE id = :id', ['id' => $photo_id])) {
			return true;
		}
		$this->error = 'no such user or photo: ' . empty($res) . ' | ';
		return false;
	}

	public function addComment($photo_id, $text) {

		if ($this->checkUserPhotoExistance($photo_id)) {
			$sql_comment = 'INSERT INTO db_ibohun.comments (photo_id, user_id, comment, timestamp)
							 VALUES (:photo_id, :user_id, :comment, :timestamp)';
			$sql_inc_com = 'UPDATE db_ibohun.photos SET comments = comments + 1 WHERE id = :id';
			$params = [
				'photo_id' => $photo_id,
				'user_id' => $_SESSION['user']['id'],
				'comment' => $text,
				'timestamp' => date('Y-m-d H:i:s')
			];

			return $this->db->query($sql_comment, $params)
				&& $this->db->query($sql_inc_com, ['id' => $photo_id]);
		}
		$this->error = 'Photo was deleted';
		return false;
	}

	public function getComments() {

	}

}