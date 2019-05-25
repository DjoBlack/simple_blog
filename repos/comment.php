<?php 
require_once './config/connection.php';
require_once './models/comment_model.php';

class CommentRepo 
{
	public static function getByPostID($postID) {
		$stmt = self::connection()->prepare('SELECT u.id AS user_id, c.id AS comment_id, c.post_id, c.body, c.timestamp, u.email 		 FROM comments AS c
									  JOIN users AS u ON u.id = c.user_id 
									  WHERE post_id = ?
									  ORDER BY timestamp DESC
									  LIMIT 10');
		$stmt->execute([$postID]);

		return $stmt->fetchAll(PDO::FETCH_CLASS, 'Comment');
	}

	public static function create($body, $user_id, $post_id) {
		$stmt = self::connection()->prepare('INSERT INTO comments (body, user_id, post_id) VALUES (?, ?, ?)');
		$stmt->execute([$body, $user_id, $post_id]);
	}

	public static function deleteCommentById ($comment_id) {
		$stmt = self::connection()->prepare('DELETE FROM comments WHERE id = ?');
		$stmt->execute([$comment_id]);
	}

	public static function updateCommentById ($new_comment, $comment_id) {
		$stmt = self::connection()->prepare('UPDATE comments
									  SET body = ? 
									  WHERE id = ?');
		$stmt->execute([$new_comment, $comment_id]);
	}

	private static function connection() {
		return Connection::instance()->getConn();
	}
	
}