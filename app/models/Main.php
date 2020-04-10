<?php

namespace app\models;

use app\core\Model;

class Main extends Model {

	public function getPhotos() {

		$sql = 'SELECT id, path, username, timestamp, likes, comments FROM db_ibohun.photos ORDER BY id DESC';
		$photos = $this->db->row($sql);

		if (isset($_SESSION['user'])) {
			$sql = 'SELECT photo_id FROM db_ibohun.likes WHERE user_id = :user_id';
			$user_likes = $this->db->columnAllOccurs($sql, ['user_id' => $_SESSION['user']['id']]);
		}

		foreach ($photos as $key => $photo) {
			if (isset($user_likes)) {
				$photos[$key]['liked'] = in_array($photo['id'], $user_likes) ? 'fa-heart' : 'fa-heart-o';
			}

			$sql = 'SELECT photo_id, user_id, comment as text, timestamp FROM db_ibohun.comments WHERE photo_id = :photo_id';
			$comments = $this->db->row($sql, ['photo_id' => $photo['id']]);

			foreach ($comments as $k => $comment) {
				$sql = 'SELECT username FROM db_ibohun.users WHERE id = :id';
				$username = $this->db->column($sql, ['id' => $comment['user_id']]);
				$comments[$k]['username'] = $username;
				$comments[$k]['date'] = date('M j, Y', strtotime($comment['timestamp']))
										.' at '.date('H:i', strtotime($comment['timestamp']));
			}

			$photos[$key]['user-comments'] = $comments;
			$photos[$key]['date'] = date('M j, Y', strtotime($photos[$key]['timestamp']))
									.' at '.date('H:i', strtotime($photos[$key]['timestamp']));

			if ($photos[$key]['likes'] == 1) {
				$photos[$key]['likes-txt'] = ' like';
			} else {
				$photos[$key]['likes-txt'] = ' likes';
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

	public function sendCommentNotification($photo_id) {

		$user_id = $this->db->column('SELECT user_id FROM db_ibohun.photos WHERE id = :id', ['id' => $photo_id]);
		$send_notifications = $this->db->column('SELECT notifications FROM db_ibohun.users WHERE id = :id', ['id' => $user_id]);

		// TODO: uncomment when notification setting is ready

		if (/*$send_notifications == true &&*/ $user_id != $_SESSION['user']['id']) {
			require 'app/lib/mail.php';

			$title = '42 Camagru: New comment 🆕';
			$port = $_SERVER['SERVER_PORT'];
			$host = $_SERVER['HTTP_HOST'];
			$message = wordwrap("Some of your snaps has been commented. Check it on: http://$host:$port/");
			$email = $this->db->column('SELECT email FROM db_ibohun.users WHERE id = :id', ['id' => $user_id]);

			return (sendMail($email, $title, $message));
		}
		return true;
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
				&& $this->db->query($sql_inc_com, ['id' => $photo_id])
				&& $this->sendCommentNotification($photo_id);
		}
		$this->error = 'Photo was deleted';
		return false;
	}

	public function delComment($photo_id, $timestamp, $username) {
		if (isset($_SESSION['user']) && $_SESSION['user']['username'] == $username) {
			$user_id = $this->db->column('SELECT id FROM db_ibohun.users WHERE username = :username', ['username' => $username]);

			return $this->db->query('DELETE FROM db_ibohun.comments WHERE photo_id = :photo_id AND user_id = :user_id AND timestamp = :timestamp',
					['photo_id' => $photo_id, 'user_id' => $user_id, 'timestamp' => $timestamp])
				&& $this->db->query('UPDATE db_ibohun.photos SET comments = comments - 1 WHERE id = :id',
					['id' => $photo_id]);
		}
		$this->error = 'Comment was not found';
		return false;
	}

}