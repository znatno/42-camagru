<?php

namespace app\models;

use app\core\Model;

class Main extends Model {

	public function getPhotos() {

		$sql = 'SELECT id, path, username, timestamp as date, likes, comments FROM db_ibohun.photos ORDER BY id DESC';
		$photos = $this->db->row($sql);

		if (isset($_SESSION['user'])) {
			$sql = 'SELECT photo_id FROM db_ibohun.likes WHERE user_id = :user_id';
			$user_likes = $this->db->columnAllOccurs($sql, ['user_id' => $_SESSION['user']['id']]);
		}

		foreach ($photos as $key => $photo) {
			if (isset($_SESSION['user'])) {
				$photos[$key]['liked'] = in_array($photo['id'], $user_likes) ? 'fa-heart' : 'fa-heart-o';
			}

			$sql = 'SELECT photo_id, user_id, comment as text, timestamp as date FROM db_ibohun.comments WHERE photo_id = :photo_id';
			$comments = $this->db->row($sql, ['photo_id' => $photo['id']]);

			foreach ($comments as $k => $comment) {
				$sql = 'SELECT username FROM db_ibohun.users WHERE id = :id';
				$username = $this->db->column($sql, ['id' => $comment['user_id']]);
				$comments[$k]['username'] = $username;
				$comments[$k]['date'] = date('M j, Y', strtotime($comment['date']))
										.' at '.date('H:i', strtotime($comment['date']));
			}

			$photos[$key]['user-comments'] = $comments;
			$photos[$key]['date'] = date('M j, Y', strtotime($photos[$key]['date']))
									.' at '.date('H:i', strtotime($photos[$key]['date']));
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
				'comment' => htmlspecialchars($text, ENT_QUOTES),
				'timestamp' => date('Y-m-d H:i:s')
			];

			return $this->db->query($sql_comment, $params)
				&& $this->db->query($sql_inc_com, ['id' => $photo_id]);
		}
		$this->error = 'Photo was deleted';
		return false;
	}

	public function delComment($photo_id, $date, $username) {

		if (isset($_SESSION['user']) && $_SESSION['user']['username'] == $username) {

			$user_id = $this->db->column('SELECT id FROM db_ibohun.users WHERE username = :username', ['username' => $username]);

			$this->db->query('DELETE');
		}
	}

}