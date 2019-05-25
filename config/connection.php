<?php

require_once './config/config.php';

class Connection 
{
	private static $instance;

	protected $conn;

	protected function __construct() 
		{
			$this->conn = new PDO('mysql:host='.Config::DB_HOST.'; dbname=' .Config::DB_NAME, Config::DB_LOGIN, Config::DB_PASS);
			$this->conn->exec('set names utf8');
		}

	public static function instance() {
		if (self::$instance == null) {
			self::$instance =  new self();
		}
		return self::$instance;
	} 

	public function getConn() {
		return $this->conn;
	}

} 