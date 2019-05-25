<?php

	require_once './config/connection.php';
	require_once './models/user_model.php';
	require_once './config/utils.php';
	
	class UserRepo {

		public static function create($mail, $pass)
		{
			$salt = Utils::generateSalt();
			$preparePassword = self::preparePassword($pass, $salt);
			$create = self::connection()->prepare('INSERT INTO users (email, password, salt) VALUES (?, ?, ?)');
			$create->execute([$mail, $preparePassword, $salt]);
		}

		public static function getUser($mail, $pass) 
		{
			$user = self::getUserByEmail($mail);

			if ($user && self::preparePassword($pass, $user->salt) == $user->password) {
				
				return $user;
			}
			

			return false;
		}


		private static function preparePassword($pass, $salt)
		{
			return hash('sha256', $pass . $salt);
		}

		public static function getUserByEmail($mail)
		{
			$getUserByEmail = self::connection()->prepare('SELECT * FROM users WHERE email = ?');
			$getUserByEmail->execute([$mail]);

			$getUserByEmail->setFetchMode(PDO::FETCH_CLASS, 'User');
			return $getUserByEmail->fetch();
		}

		public static function getMailById($id) {
		$stmt = self::connection()->prepare('SELECT email FROM users WHERE id = ?');
		$stmt->execute([$id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
		return $stmt->fetch();
	}

		private static function connection() {
		return Connection::instance()->getConn();
	}

}
