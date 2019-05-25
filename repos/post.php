<?php
require_once './config/connection.php';
require_once './models/post_model.php';

class PostRepo {

	public static function getAll() {
		$result = self::connection()->query('SELECT p.id, p.title, p.body AS post_body, p.user_id, p.date, u.email, c.body AS comment_doby, COUNT(c.id) AS count_num
							FROM posts AS p
							JOIN users AS u ON u.id = p.user_id
							LEFT JOIN comments AS c ON p.id = c.post_id
							GROUP BY p.id
							ORDER BY p.date DESC');
		return $result->fetchAll(PDO::FETCH_CLASS, 'Post');
	}

	public static function create($title, $body, $user_id) {
		$stmt = self::connection()->prepare('INSERT INTO posts (title, body, user_id) VALUES (?, ?, ?)');
		$stmt->execute([$title, $body, $user_id]);
	}

	public static function getPostById($id) {
		$stmt = self::connection()->prepare('SELECT p.id, p.title, p.body, p.date, u.email, p.user_id
									  FROM posts AS p
									  JOIN users AS u ON u.id = p.user_id 
									  WHERE p.id = ?');
		$stmt->execute([$id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Post');
		return $stmt->fetch();
	}

	public static function getPostsByUserId($user_id) {
		$stmt = self::connection()->prepare('SELECT p.id, p.title, p.body, p.date, p.user_id, u.email
									  FROM posts AS p
									  JOIN users AS u ON p.user_id = u.id
									  WHERE p.user_id = ? 
									  ORDER BY p.date DESC');
		$stmt->execute([$user_id]);
		return $stmt->fetchAll(PDO::FETCH_CLASS, 'Post');
	}

	public static function deletePostById ($id) {
		$stmt = self::connection()->prepare('DELETE FROM posts WHERE id  = ?');
		$stmt->execute([$id]);
	}

	private static function connection() {
		return Connection::instance()->getConn();
	}

}